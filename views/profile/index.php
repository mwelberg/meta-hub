<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Meta-Hub';
?>
<div class="container">
    <div class="jumbotron" style="text-align:left">
      <div class="row">
        <div class="col-lg-6">
          <?php
            if (Yii::$app->user->identity->image)
              echo '<img class="img-responsive" src="'.Yii::$app->user->identity->image .'" alt="profile image">';
          ?>
          <h1><?php echo Yii::$app->user->identity->username;?></h1>
          <p class="lead"><?php echo Yii::$app->user->identity->email;?></p>
          <a href="<?php echo Url::to(['/profile/settings']);?>"><span class="glyphicon glyphicon-cog"></span> Settings</a>
        </div>
        <div class="col-lg-6">
          <p><b>Description:</b></p>
          <hr>
          <p class="lead"><?php echo Yii::$app->user->identity->description;?></p>
        </div>
      </div>
    </div>
</div>
