<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\lecture\models\GuestLectures */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guest-lectures-form">
<div class="box box-primary">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group col-lg-6 col-sm-12">
    
      <?= $form->field($model, 'sem_id')->dropdownList($model->semname,['prompt' =>'Select Semister']); ?>
      
      </div>

               <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'topicname')->textInput(['maxlength' => true]) ?>
    </div>
       <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'apiUrl')->textarea(['rows' => 3]) ?>
    </div>
       <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'speaker_id')->dropdownList($model->spname,['prompt' =>'Select Speaker']); ?>
    </div>
       <div class="form-group col-lg-6 col-sm-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
