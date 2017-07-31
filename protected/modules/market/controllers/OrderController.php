<?php
namespace app\protected\modules\market\controllers;

use Yii;
use yii\web\Controller;
use app\protected\modules\market\models\ItemForm;

class DashboardController extends Controller
{
  /**
   * The action to load the list of purchased items
   */
  public function actionIndex()
  {
    //only logged in users should be able to see their order
    if(!Yii::$app->user->isGuest) {
      return $this->render('order');
    }
  }

  /**
   * The action to buy the selected items
   */
  public function actionBuy()
  {
    $model = new OrderForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate())
    {
      if ($model->buy()) {
        Yii::$app->session->setFlash('success', $value = 'The purchase was successful.', $removeAfterAccess = true);
        //TODO:find out how to adequately redirect
        //return $this->redirect(['market/index']);
      }
      else {
        Yii::$app->session->setFlash('danger', $value = 'An error occured while purchasing the item.', $removeAfterAccess = true);
        return $this->goBack();
      }
    }

    //if the above steps are not applied offer the registration form
    return $this->render('market/oder', ['model' => $model]);

  }


}

?>
