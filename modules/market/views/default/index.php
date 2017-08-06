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
   <table class="table table-striped">
     <thead>
       <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Price</th>
       </tr>
     </thead>
   <?php foreach ($items as $item): ?>
     <tr>
       <?php
         echo '<td>'.$item->ID.'</td>';
         echo '<td>'.$item->name.'</td>';
         echo '<td>'.$item->price.'</td>';
       ?>
     </tr>
    <?php endforeach;?>
  </table>
  <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
