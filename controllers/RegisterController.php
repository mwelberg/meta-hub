<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RegisterForm;

class RegisterController extends Controller
{

  /**
   * The action to register a new user
   * It has avalidated RegisterForm and a blank new user to wirk with
   */
  public function actionIndex()
  {
    $model = new RegisterForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate())
    {
      if ($model->register()) {
        Yii::$app->session->setFlash('success', $value = 'Successfully registered as a user. Welcome!', $removeAfterAccess = true);
        return $this->redirect(['site/login']);
      }
      else {
        Yii::$app->session->setFlash('danger', $value = 'An error occured while registrating.', $removeAfterAccess = true);
        return $this->goBack();
      }
    }

    //if the above steps are not applied offer the registration form
    return $this->render('index', ['model' => $model]);

  }


}

?>
