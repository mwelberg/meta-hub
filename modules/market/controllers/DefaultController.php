<?php
namespace app\modules\market\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\market\models\MarketForm;
use app\modules\market\models\ItemRecord;

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
      /**
       * If the current user is not a guest
       * he shall be permitted to see other users profiles page
       */
      $query = ItemRecord::find();
      $pagination = new Pagination([
        'defaultPageSize' => 2,
        'totalCount' => $query->count(),
      ]);

      $items = $query->orderBy('name')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

      return $this->render('index', ['model' => $model, 'items' => $items, 'pagination' => $pagination]);
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
      /**
       * If the current user is not a guest
       * he shall be permitted to see other users profiles page
       */
      $query = ItemRecord::find();
      $pagination = new Pagination([
        'defaultPageSize' => 2,
        'totalCount' => $query->count(),
      ]);

      $items = $query->orderBy('name')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

      //if the above steps are not applied offer the market view (index) with the market form
      return $this->render('index', ['model' => $model, 'items' => $items, 'pagination' => $pagination]);
    }
    $this->goHome();
  }


}

?>
