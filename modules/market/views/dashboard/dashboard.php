<!--
 * View with dashboard for administrators
 *  * drinks ordered this month
 *  * adding new items
 -->
 <?php
 use yii\helpers\Url;
 use yii\bootstrap\ActiveForm;
 use yii\helpers\Html;
 /* @var $this yii\web\View */

 $this->title = 'Meta-Hub';
 ?>
 <div class="container">
   <?php
     foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
       echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
     }
   ?>
     <div class="row">
       <div class="col-md-6">
         <!--TODO: List of drinks purchased this month -> need refill-->
       </div>
       <div class="col-md-6">
         <h1>Add new item</h1>
         <?php
           $form = ActiveForm::begin([
               'id' => 'item-form',
               'layout' => 'horizontal',
               'fieldConfig' => [
                   'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                   'labelOptions' => ['class' => 'col-lg-1 control-label'],
               ],
               'options' => ['enctype' => 'multipart/form-data'],
           ]);
         ?>

         <?= $form->field($model, 'name')->textInput() ?>
         <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>

         <div class="form-group">
           <div class="col-lg-offset-1 col-lg-11">
             <?= Html::submitButton('Add', ['class' => 'btn btn-primary', 'name' => 'add-button']) ?>
           </div>
         </div>
         <?php ActiveForm::end(); ?>
       </div>
     </div>
 </div>
