<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\quiz\models\QuizMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-master-form">
<div class="box box-primary">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
        <div class="form-group col-lg-6 col-sm-12">

  <?= $form->field($model, 'sem_id')->dropdownList($model->semname,[ 'prompt'=>'Select Semister',
          'onchange'=>' $.get( "'.Url::toRoute('quizmaster/loadcourses').'", { sem_id: $(this).val() } )
                                                                  .done(function( data )
                                                                  {
                                                                      $( "#quizmaster-courseid" ).html( data );
          console.log(data);
                                                                    });
                  
          ']); ?>
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'courseId')->dropdownList([ 'prompt'=>'Select Course']) ?>
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'validFrom')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Valid From ...' ],
                		'value'=>date("Y-m-d"), 'pluginOptions' => ['autoclose' => true ,'format' => 'yyyy-mm-dd',] ] ) ?>
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'validTime')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Valid to ...' ],
                		'value'=>date("Y-m-d"), 'pluginOptions' => ['autoclose' => true ,'format' => 'yyyy-mm-dd',] ] ) ?> 
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'quizTime')->textInput(['maxlength' => true]) ?>
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'totalMarks')->textInput() ?>
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'passMarks')->textInput() ?>
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'eachquestioncarries')->textInput() ?>
    </div>
        <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active', ], ['prompt' => '']) ?>

</div>
       <div class="form-group col-lg-6 col-sm-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
