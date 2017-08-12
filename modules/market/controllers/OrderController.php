<?php
namespace app\modules\market\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\market\models\OrderRecord;

class OrderController extends Controller
{
  /**
   * The action to load the list of purchased items
   */
  public function actionIndex()
  {
    //only logged in users should be able to see their order
    if(!Yii::$app->user->isGuest) {
      $query = OrderRecord::findByUserId(Yii::$app->user->identity->ID);
      $pagination = new Pagination([
        'defaultPageSize' => 10,
        'totalCount' => $query->count(),
      ]);

      $orders = $query->orderBy('timestmp')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

      return $this->render('order', ['orders' => $orders, 'pagination' => $pagination]);
    }
  }



}

?>
