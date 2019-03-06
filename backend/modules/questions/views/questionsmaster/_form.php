<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model backend\modules\questions\models\QuestionsMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-master-form">
<div class="box box-primary">
   <div class="box-body">  

    <?php $form = ActiveForm::begin([
    'enableAjaxValidation'      => true,
    'enableClientValidation'    => false,
    'validateOnChange'          => false,
    'validateOnSubmit'          => true,
    'validateOnBlur'            => false,
]); ?>

 <?= $form->field($model, 'quizId',['enableAjaxValidation' => true])->dropDownList($model->allquizes) ?>

<?= $form->field($model, 'questionsoptions',['enableAjaxValidation' => true])->widget(MultipleInput::className(), [
    'max' => 3,
    'columns' => [
    		[
    		'name'  => 'question',
    		'type' => 'textarea',
    		'title' => 'Question',
    		'value' => $model->question,
    		'options' => [
    			
    				'placeholder' => 'Please Enter Question',
    				'style' => array('width'=>'100%')
    				
    			
    		
    		],
    		'enableError' =>true,
    		],
    		[
    				
    				'name'  => 'options1',
    				'title' => 'Option-1',
    				'type'  => 'textarea',
    				'value' => $model->options1,
    				'options' => [
    						'placeholder' => 'options-1',
    						],
    				'enableError' =>true,
    				
    				
    		],
    		[
    		
    		'name'  => 'options2',
    				'title' => 'Option-2',
    		'type'  => 'textarea',
    		'value' => $model->options2,
    		'options' => [
    				'placeholder' => 'options-2',
    		],
    		'enableError' =>true,
    		
    		
    		],
    		[
    		
    		'name'  => 'options3',
    				'title' => 'Option-3',
    		'type'  => 'textarea',
    		'value' => $model->options3,
    		'options' => [
    				'placeholder' => 'options-3',
    		],
    		'enableError' =>true,
    		
    		
    		],
    		[
    	
    		'name'  => 'options4',
    		'type'  => 'textarea',
    				'title' => 'Option-4',
    		'value' => $model->options4,
    		'options' => [
    				'placeholder' => 'options-4',
    		],
    		'enableError' =>true,
    		
    		
    		],
    		[
    		'name'  => 'answer',
    		'type'  => 'dropDownList',
    				'title' => 'Answer',
			'value' => $model->answer,
    		//'title' => 'Status',
    		//'defaultValue' => 1,
    		'items' => ['1' =>'options-1','2' =>'options-2','3' =>'options-3','4' =>'options-4'],
    				'options' => [
    						'prompt' => 'select answers',
    				],
    		],
    		
    		
    		
    		
       /*  [
    		'title' => 'Options',        		
            'name'  => 'optionId',
            'type'  => 'checkboxList',
        	'defaultValue' => @$populatedinfo['ans_list'],
            'items' => $list,
        	'enableError' =>true,
        		
        ], 		 */
    		/*[
    		'name' => 'list',
    		'type' => 'hiddeninput',
    		'value' => json_encode($opt_list),
    		
    		],*/
    		
    		
    		
    		
    		
        
    ]
 ])->label(false);
?>

<?php if(yii::$app->controller->action->id == 'update')
	{?>
	<?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active', ], ['prompt' => '']) ?>
	<?php }?>


   
   
    

    <div class="form-group">
    
    <?php if(yii::$app->controller->action->id == 'create'){?>
        <?= Html::submitButton( 'Create', ['class' =>'btn btn-primary']) ?>
        <?php }?>
        <?php if(yii::$app->controller->action->id == 'update'){?>
        <?= Html::submitButton( 'Update', ['class' =>'btn btn-primary']) ?>
        <?php }?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
<?php 
//print_r($model->selectedSetId);exit();
$act = yii::$app->controller->action->id;
$this->registerJs("
		
		
		var actnew = '$act';
		if(actnew == 'update')
		{
		 $('.js-input-plus').css('display', 'none' );
		}
		
	
		$('#questionmastermain-status').val('$model->status');
		$('#questionmastermain-questionsoptions-0-question').val('$model->question');
		$('#questionmastermain-questionsoptions-0-options1').val('$model->options1');
		$('#questionmastermain-questionsoptions-0-options2').val('$model->options2');
		$('#questionmastermain-questionsoptions-0-options3').val('$model->options3');
		
		$('#questionmastermain-questionsoptions-0-answer').val('$model->answer');
		
		
		
		
		$('#questionmastermain-quizid').val($model->quizId);
		", View::POS_READY , 'my-options');
?> 
                                                                                                                                                                                
<style>
.box {
margin-top:25px;
}
@media screen and (min-width:760px) {
.ans {
    margin-top: -100px !important;
}}
</style>



  