<!--
 * View with list of ordered items
 * and submit order
 -->
  <?php
  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
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
          <?php
           echo "<p>Do you really want to buy $item->name for €$item->price ?</p>";
            $form = ActiveForm::begin([
                'id' => 'order-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]);
          ?>

          <?= $form->field($model, 'item_id')->hiddenInput(['value' => $model->item_id])->label(false); ?>

          <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
              <?= Html::submitButton('Buy', ['class' => 'btn btn-primary', 'name' => 'buy-button']) ?>
            </div>
          </div>
          <?php ActiveForm::end(); ?>
        </div>
      </div>
 </div>
