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
      $model->register();
      return $this->goBack();
    }

    //if the above steps are not applied offer the registration form
    return $this->render('index', ['model' => $model]);

  }


}

?>
