<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model backend\modules\project\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">
<div class="box box-primary">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
            <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
            <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    </div>
            <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'from_date')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter from date ...' ],
                		'value'=>date("Y-m-d"), 'pluginOptions' => ['autoclose' => true ,'format' => 'yyyy-mm-dd',] ] ) ?>
    
    </div>
            <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'to_date')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter to date ...' ],
                		'value'=>date("Y-m-d"), 'pluginOptions' => ['autoclose' => true ,'format' => 'yyyy-mm-dd',] ] ) ?>
    </div>

        <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active', ], ['prompt' => 'Select Project Status']) ?>
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
    height: 5px;
}
</style>
