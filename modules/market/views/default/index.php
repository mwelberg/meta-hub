<!-- View with list of items -->
 <?php
 use Yii;
 use yii\helpers\Url;
 use yii\bootstrap\ActiveForm;
 use yii\helpers\Html;
 use yii\widgets\LinkPager;

 /* @var $this yii\web\View */

 $this->title = 'Meta-Hub';
 ?>
   <?php
     foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
       echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
     }
   ?>

   <table class="table table-striped">
     <thead>
       <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Price</th>
         <th></th>
       </tr>
     </thead>
   <?php
     /*$form = ActiveForm::begin([
         'id' => 'market-form',
         'layout' => 'horizontal',
         'fieldConfig' => [
             'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
         ],
         'options' => ['enctype' => 'multipart/form-data'],
     ]);*/
     foreach ($items as $item): ?>
     <tr>
       <?php
         echo '<td>'.$item->ID.'</td>';
         echo '<td>'.$item->name.'</td>';
         echo '<td>'.$item->price.'</td>';
         //echo Html::HiddenInput('item_id', $item->ID);
         //echo Html::HiddenInput('user_id', Yii::$app->user->identity->ID);
         //echo '<td>'.$form->field($model, 'quantity')->textInput(['type' => 'number']).'</td>';
         echo '<td>'.Html::a('Buy', ['/market','item_id' => $item->ID],['class' => 'btn btn-primary', 'name' => 'buy-button']).'</td>';
       ?>
     </tr>
    <?php
      endforeach;
      //ActiveForm::end();
    ?>
  </table>
  <?= LinkPager::widget(['pagination' => $pagination]) ?>
