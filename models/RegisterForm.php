<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\BackendUser;
use yii\validators\InlineValidator;
/**
 * RegisterForm is the model behind the registration form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    public $email;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username, email, password + second time password are required
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            // username is validated by the 'unique' validator
      	    ['username', 'unique', 'targetClass' => '\app\models\BackendUser', 'message' => 'This username is already taken.'],
            // username must be of type string and of at least 3 and maximum 18 characters length
            ['username', 'string', 'length' => [3, 18]],
            // password must have at least 8 characters
            ['password', 'string', 'min' => 8],
      	    // email address is by the 'unique' validator
      	    ['email', 'unique', 'targetClass' => '\app\models\BackendUser', 'message' => 'This address is already taken.'],
      	    // passwords are validated by this inline comparison
      	    ['password_repeat','compare','compareAttribute' => 'password'],
              ];
    }

    /**
     * Registers a user using the provided username, email address and password.
     * @return bool whether the user is registered successfully
     */
    public function register()
    {
      if ($this->validate()) {
    		$user = new BackendUser();
    		$user->username = $this->username;
    		$user->email = $this->email;
    		$user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->save();
    		return true;
      }
  	  return false;
    }

}
