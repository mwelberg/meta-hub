<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use app\models\BackendUser;
use yii\validators\InlineValidator;
use yii\web\UploadedFile;
use yii\imagine\Image;
/**
 * ProfileForm is the model behind the user settings form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ProfileForm extends Model
{
    public $image;
    public $description;
    public $email;
    public $password;
    public $password_repeat;
    public $imageFile;
    public $imageStore = 'uploads/';
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email address is by the 'unique' validator
      	    ['email', 'unique', 'targetClass' => '\app\models\BackendUser', 'message' => 'This address is already taken.'],
      	    // passwords are validated by this inline comparison
      	    ['password_repeat','compare','compareAttribute' => 'password'],
            //profile picture upload rule
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            //restrict the description length to 65535 bytes
            ['description', 'string', 'max' => 65535],
            // password must have at least 8 characters
            ['password', 'string', 'min' => 8],
              ];
    }

    /**
     * save function to save profile settings of this user
     *
     */
    public function save()
    {
        if ($this->validate()) {
            //get the current user's identity
            $user = BackendUser::findOne(Yii::$app->user->identity->ID);
            // write description value to the database
            if ($this->description != '')
              $user->description = Html::encode($this->description);
            if ($this->password != '')
              // make sure the password is stored safely
              $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $imagePath = $this->createImagePath($this->imageFile);
            if ( $imagePath != $this->imageStore) {
              //save the image file to the upload directory
              $this->imageFile->saveAs($imagePath);
              // resize the image to thunbnail size (all images must be equal of size)
              Image::thumbnail($imagePath, 180, 180)->save($imagePath);
              // write image url to database
              $user->image = $imagePath;
            }
            if ($this->email != '')
              $user->email = $this->email;
            //finally save all changes to the database
            $user->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validate basename and file extension for user uploaded image file
     */
     public function createImagePath($imageFile){
       $basePath = $this->imageStore;
       if (!empty($imageFile) && $imageFile->baseName != '' && $imageFile->extension != '') {
           $basePath .= $imageFile->baseName;
           $basePath .= '.';
           $basePath .= $imageFile->extension;
       }
       return $basePath;
     }

}
