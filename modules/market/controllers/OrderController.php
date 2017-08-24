<?php
namespace app\modules\market\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\market\models\MarketForm;
use app\modules\market\models\OrderRecord;
use app\modules\market\models\ItemRecord;


class OrderController extends Controller
{
  /**
   * The action to load the list of purchased items
   */
  public function actionIndex()
  {
    //only logged in users should be able to see their order
    if(!Yii::$app->user->isGuest) {
      $model = new MarketForm();
       if (Yii::$app->getRequest()->getQueryParam('item_id'))
       {
         //TODO: This is as unsafe as it can get!! Change ASAP
         $model->item_id = Yii::$app->getRequest()->getQueryParam('item_id');
         $model->user_id = Yii::$app->user->identity->ID;
         $item = ItemRecord::findItem($model->item_id);
         $query = OrderRecord::findByUserId(Yii::$app->user->identity->ID);
         $pagination = new Pagination([
           'defaultPageSize' => 10,
           'totalCount' => $query->count(),
         ]);

         $orders = $query->orderBy('timestmp')
           ->offset($pagination->offset)
           ->limit($pagination->limit)
           ->all();

         return $this->render('index', ['model' => $model, 'orders' => $orders, 'pagination' => $pagination, 'item' => $item]);
       }
       if ($model->load(Yii::$app->request->post()))
       {
         if ($model->buy()) {
           Yii::$app->session->setFlash('success', $value = 'The item was successfully bought.', $removeAfterAccess = true);
           return $this->redirect(['/market']);
         }
         else {
           Yii::$app->session->setFlash('danger', $value = 'An error occured while placing the order.', $removeAfterAccess = true);
           return $this->goBack();
         }
       }
       return $this->render('index', ['model' => $model, 'orders' => $orders, 'pagination' => $pagination]);
    }
  }



}

?>
