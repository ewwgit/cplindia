<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\subject\models\Subjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subjects-form">
<div class="box box-primary">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
<div class="form-group col-lg-7 col-sm-12">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-7 col-sm-12">

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
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
