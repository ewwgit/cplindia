<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\courses\models\Courses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courses-form">
<div class="box box-primary">
<div class="box-body">
    <?php $form = ActiveForm::begin(); ?>

             <div class="form-group col-lg-7 col-sm-12">

    <?= $form->field($model, 'sem_name')->textInput(['maxlength' => true,'readonly'=>true]) ?>
    </div>
    
<div class="form-group col-lg-7 col-sm-12">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-7 col-sm-12">

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    </div>
    <div class="form-group col-lg-7 col-sm-12">


    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active', ], ['prompt' => 'Select course Status']) ?>
</div>
   <div class="form-group col-lg-7 col-sm-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
