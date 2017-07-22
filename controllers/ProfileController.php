<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ProfileForm;
use yii\web\UploadedFile;

class ProfileController extends Controller
{

  /**
   * The action to view the profile of a user
   */
  public function actionIndex()
  {
    /**
     * If the current user is not a guest
     * he shall be permitted to see the (his own) profile page
     */
    if (!Yii::$app->user->isGuest)
    {
      return $this->render('index');
    }
    $this->goHome();

  }

  /**
   * The action to view the profile settings of a user
   */
   public function actionSettings()
   {
     if(!Yii::$app->user->isGuest)
     {
       $model = new ProfileForm();
       if ($model->load(Yii::$app->request->post()) && $model->validate())
       {
         $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
         if($model->save()){
           //Settings saved message
           Yii::$app->session->setFlash('success', $value = 'Successfully saved the profile settings.', $removeAfterAccess = true);
           return $this->redirect(['/profile/settings']);
         }
         else {
           Yii::$app->session->setFlash('danger', $value = 'Error saving the profile settings.', $removeAfterAccess = true);
         }
       }

       //if the above steps are not applied offer the registration form
       return $this->render('settings', ['model' => $model]);
     }
     $this->goHome();
   }

}

?>
