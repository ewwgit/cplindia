<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\AssessmentsMaster */
/* @var $form yii\widgets\ActiveForm */
//print_r($model->quizTime); exit();
?>
<div class="box box-primary">
<div class="box-body">

<div id="getting-started" ></div>
</div>
</div>
<div class="box box-primary">
<div class="box-body">



					
					
			
	

<div class="assessments-master-form questions_block">
<div class=col-lg-12>
<div class="ass-details col-lg-4">
<div>You Are In <b><?= $model->questionsdecremntCount?>/<?= $model->questionsCount?></b> Question</div>
<div>Total Marks : <?= $model->totalMarks?></div>
<div>Pass Marks : <?= $model->passMarks?></div>
<div>Each Question Carrie Marks: <?= $model->eachquestioncarries?></div>
</div>
<div class=col-lg-8>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'questionId')->hiddenInput(['value'=> $model->questionId])->label(false); ?>
    <?= $form->field($model, 'incrementhidId')->hiddenInput(['value'=> $model->incrementhidId])->label(false); ?>
    
   
   <p> <?= $model->sno ?>. <?= $model->questionTitle ?></p>
				
				 <?= $form->field($model, 'optionId')->radioList($model->options)->label(false); ?>
				
				<!-- <a href="" class="custom_next_btn">NEXT</a> -->

  
        <?= Html::submitButton( 'Next', ['class' => 'btn btn-primary']) ?>
    

    <?php ActiveForm::end(); ?>
    </div>
    </div>

</div>
</div>
</div>

<?php 

$this->registerJs("	
		$('#getting-started')
  .countdown('$model->quizTime', function(event) {
	
    $(this).html(event.strftime('<div class=\"time-mian col-lg-12\"><div class=\"min-mian\">%M</div><div class=\"mid-main col-lg-2\">:</div><div class=\"sec-main\">%S</div></div>'))
	
		.on('finish.countdown', function(event){
window.location = '" . \Yii::$app->urlManager->createUrl(['quiz/quizmaster/testcomplete','id'=>$model->quizId]) . "';
		
});
		
});
		", View::POS_READY , 'my-options');
?>
<style>
.questions_block .form-group label{
width:100%;
}
.time-mian{
text-align: center !important;
}
.min-mian {
   	width: 25px;
    float: left;
    border: 1px solid silver;
    text-align: center;
    font-weight: bold;
    background: linear-gradient(to bottom, #ffffff 38%,#cccccc 100%);
    color: #000;}
.sec-main {
     width: 25px;
    float: left;
    border: 1px solid silver;
    text-align: center;
    font-weight: bold;
    background: linear-gradient(to bottom, #ffffff 38%,#cccccc 100%);
    color: #000;}
.mid-main {
 	width: 10px;
    float: left;
    text-align: center;
    font-weight: bold;
    color: #000;}
    .ass-details {
    float: right;
}
</style>