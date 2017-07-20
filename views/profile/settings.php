<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ProfileForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-settings">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Edit the following fields to update your profile:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'settings-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

        <?= $form->field($model, 'description')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>
	<?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
	<?= $form->field($model, 'password_repeat')->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
