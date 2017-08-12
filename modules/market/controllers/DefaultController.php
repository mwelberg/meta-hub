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
   * Define the defaultPageSize for pagination objects in this class
   */
   private $pageSize = 10;
  /**
   * The action to load the list of purchasable items
   */
  public function actionIndex()
  {
    //only logged in users should be able to see the market
    if(!Yii::$app->user->isGuest) {
      $model = new MarketForm();
       if ($model->load(Yii::$app->request->post()) && $model->validate())
       {
         if ($model->buy()) {
           Yii::$app->session->setFlash('success', $value = 'The item was successfully bought.', $removeAfterAccess = true);
           //TODO:find out how to adequately redirect
           //TODO: redirect the user to his order/overview
           return $this->redirect(['market']);
         }
         else {
           Yii::$app->session->setFlash('danger', $value = 'An error occured while placing the order.', $removeAfterAccess = true);
           return $this->goBack();
         }
       }
       else {
         Yii::$app->session->setFlash('warning', $value = 'MarketForm could not be loaded.', $removeAfterAccess = true);
       }
      $query = ItemRecord::find();
      $pagination = new Pagination([
        'defaultPageSize' => $this->pageSize,
        'totalCount' => $query->count(),
      ]);

      $items = $query->orderBy('name')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

      return $this->render('index', ['model' => $model, 'items' => $items, 'pagination' => $pagination]);
    }
  }
}

?>
