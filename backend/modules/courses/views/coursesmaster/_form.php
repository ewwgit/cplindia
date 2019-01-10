<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\courses\models\CoursesMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courses-master-form">
	<div class="box box-primary">
		<div class="box-body"> 

    <?php $form = ActiveForm::begin(); ?>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'courseName')->textInput(['maxlength' => true]) ?>
    </div>
  <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    </div>
   <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'content')->textarea(['rows' => 3]) ?>
    </div>
<div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'courseImage')->fileInput(); ?>
    </div>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'attachmentUrl')->fileInput(); ?>
    </div>

<div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active', ], ['prompt' => 'Select Status']) ?>
    </div>

    

<div class="form-group col-lg-6 col-sm-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
	<style>
	
.help-block {
    height: 1px;
}
</style>
