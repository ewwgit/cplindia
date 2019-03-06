<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\assignment\models\Assignment */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Upload Your Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="assignment-form">
<div class="box box-primary">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
            <div class="form-group col-lg-7 col-sm-12">

    <?= $form->field($model, 'sem_id')->textInput(['maxlength' => true,'readonly'=>true]) ?>
    </div>
    
        <div class="form-group col-lg-7 col-sm-12">

    <?= $form->field($model, 'asId')->textInput(['maxlength' => true,'readonly'=>true]) ?>
    </div>
         
    <div class="form-group col-lg-7 col-sm-12">

    <?= $form->field($model, 'attachmentUrl')->fileInput(); ?>
    </div>

        <div class="form-group col-lg-7 col-sm-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
