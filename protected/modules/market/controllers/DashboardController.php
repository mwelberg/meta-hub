<?php
namespace app\protected\modules\market\controllers;

use Yii;
use yii\web\Controller;
use app\protected\modules\market\models\ItemForm;

class DashboardController extends Controller
{
  /**
   * The action to load the dashboard
   */
  public function actionIndex()
  {
    if(!Yii::$app->user->isGuest /*TODO: && Yii::$app->user->isAdmin()*/) {
      return $this->render('dashboard');
    }
  }

  /**
   * The action to add a new item to the list of items
   */
  public function actionItem()
  {
    if(!Yii::$app->user->isGuest /*TODO: && Yii::$app->user->isAdmin()*/) {
      $model = new ItemForm();
      if ($model->load(Yii::$app->request->post()) && $model->validate())
      {
        if ($model->add()) {
          Yii::$app->session->setFlash('success', $value = 'The new item has been successfuly added.', $removeAfterAccess = true);
          //TODO:find out how to adequately redirect
          //return $this->redirect(['market/dashboard']);
          return $this->goBack()
        }
        else {
          Yii::$app->session->setFlash('danger', $value = 'An error occured while adding the new item.', $removeAfterAccess = true);
          return $this->goBack();
        }
      }
      //if the above steps are not applied offer the dashboard view with new item form
      return $this->render('dashboard', ['model' => $model]);
    }



  }


}

?>
