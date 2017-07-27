<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = 'Meta-Hub';
?>
<div class="container">
  <?php foreach ($users as $user): ?>
      <div class="row">
        <div class="col-lg-6">
          <?php
            if ($user->image)
              echo '<img class="img-thumbnail" src="'. $user->image .'" alt="profile image" height="180px" width="180px">';
          ?>
          <h1><?php echo $user->username;?></h1>
          <p class="lead"><?php echo $user->email;?></p>
        </div>
        <div class="col-lg-6">
          <p><b>Description:</b></p>
          <hr>
          <p class="lead"><?php echo $user->description;?></p>
        </div>
    </div>
  <?php endforeach;?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
