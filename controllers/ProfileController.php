<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ProfileForm;
use yii\web\UploadedFile;
use app\models\BackendUser;
use yii\data\Pagination;

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
    if (!Yii::$app->user->isGuest) {
      return $this->render('index');
    }
    $this->goHome();

  }

  /**
   * The action to view the profile settings of a user
   */
   public function actionSettings()
   {
     if(!Yii::$app->user->isGuest) {
       $model = new ProfileForm();
       if ($model->load(Yii::$app->request->post()) && $model->validate()) {
         $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
         if($model->save()) {
           //Settings saved message
           Yii::$app->session->setFlash('success', $value = 'Successfully saved the profile settings.', $removeAfterAccess = true);
           return $this->redirect(['/profile/settings']);
         }
         else {
           Yii::$app->session->setFlash('danger', $value = 'Error saving the profile settings.', $removeAfterAccess = true);
         }
       }
       //if the above steps are not applied offer the settings form
       return $this->render('settings', ['model' => $model]);
     }
     $this->goHome();
   }

   /**
    * The action to view profiles of users
    */
   public function actionOthers()
   {
     /**
      * If the current user is not a guest
      * he shall be permitted to see other users profiles page
      */
     if (!Yii::$app->user->isGuest) {
       $query = BackendUser::find();

       $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);

        $users = $query->orderBy('username')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

       return $this->render('others', ['users' => $users, 'pagination' => $pagination]);
     }
     $this->goHome();
   }
}

?>
