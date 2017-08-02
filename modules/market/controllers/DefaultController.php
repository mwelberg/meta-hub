<?php
namespace app\modules\market\controllers;

use Yii;
use yii\web\Controller;
use app\modules\market\models\MarketForm;

class DefaultController extends Controller
{
  /**
   * The action to load the list of purchasable items
   */
  public function actionIndex()
  {
    //only logged in users should be able to see the market
    if(!Yii::$app->user->isGuest) {
      $model = new MarketForm();
      return $this->render('index', ['model' => $model]);
    }
  }

  /**
   * The action to add new items to the order
   */
  public function actionMarket()
  {
    //only logged in users should be able to see the market
    if(!Yii::$app->user->isGuest) {
      $model = new MarketForm();
      if ($model->load(Yii::$app->request->post()) && $model->validate())
      {
        if ($model->select()) {
          Yii::$app->session->setFlash('success', $value = 'The new order has been successfuly placed.', $removeAfterAccess = true);
          //TODO:find out how to adequately redirect
          //TODO: redirect the user to his order/overview
          //return $this->redirect(['market/order']);
        }
        else {
          Yii::$app->session->setFlash('danger', $value = 'An error occured while placing the order.', $removeAfterAccess = true);
          return $this->goBack();
        }
      }

      //if the above steps are not applied offer the market view (index) with the market form
      return $this->render('index', ['model' => $model]);
    }

  }


}

?>
