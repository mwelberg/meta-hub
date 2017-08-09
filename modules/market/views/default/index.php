<!-- View with list of items -->
 <?php
 use yii\helpers\Url;
 use yii\bootstrap\ActiveForm;
 use yii\helpers\Html;
 use yii\widgets\LinkPager;

 /* @var $this yii\web\View */

 $this->title = 'Meta-Hub';
 ?>
 <div class="container">
   <?php
     foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
       echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
     }
   ?>
   <?php
     $form = ActiveForm::begin([
         'id' => 'market-form',
         'layout' => 'horizontal',
         'fieldConfig' => [
             'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
         ],
         'options' => ['enctype' => 'multipart/form-data'],
     ]);
   ?>
   <table class="table table-striped">
     <thead>
       <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Price</th>
         <th>Qantity</th>
       </tr>
     </thead>
   <?php foreach ($items as $item): ?>
     <tr>
       <?php
         echo '<td>'.$item->ID.'</td>';
         echo '<td>'.$item->name.'</td>';
         echo '<td>'.$item->price.'</td>';
         echo '<td>'.$form->field($model, 'quantity')->textInput(['type' => 'number']).'</td>';
       ?>
     </tr>
    <?php endforeach;?>
  </table>
  <?= LinkPager::widget(['pagination' => $pagination]) ?>
  <div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
      <?= Html::submitButton('View order', ['class' => 'btn btn-primary', 'name' => 'viewOrder-button']) ?>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>
