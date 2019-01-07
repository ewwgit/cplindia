<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\AdminUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-users-form">
<div class="box box-primary">
		<div class="box-body"> 

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group col-lg-6 col-sm-12">

  <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">

   
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
   <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
</div>
<div class="form-group col-lg-6 col-sm-12">
   <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
</div>
<div class="form-group col-lg-6 col-sm-12">
   <?= $form->field($model, 'password')->passwordInput()?>
</div>
 <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'profileImage')->fileInput(); ?>
   </div>

   <div class="form-group col-lg-6 col-sm-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
