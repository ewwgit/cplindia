<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\events\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">
<div class="box box-primary">
<div class="box-body"> 

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group col-lg-7 col-sm-12">
    <?= $form->field($model, 'event_name')->textInput(['maxlength' => true]) ?>
</div>
    <div class="form-group col-lg-7 col-sm-12">
    <?= $form->field($model, 'event_date')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Event date' ],
                		'value'=>date("Y-m-d"), 'pluginOptions' => ['autoclose' => true ,'format' => 'yyyy-mm-dd',] ] ) ?>  
</div>


       <div class="form-group col-lg-7 col-sm-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
