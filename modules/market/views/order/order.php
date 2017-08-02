<!--
 * View with list of ordered items
 * and submit order
 -->
  <?php
  use yii\helpers\Url;
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
          <!--TODO: List of drinks with possibility to buy-->
        </div>
      </div>
 </div>
