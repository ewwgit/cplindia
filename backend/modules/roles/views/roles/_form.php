<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\roles\models\Roles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roles-form">
	<div class="box box-primary">
		<div class="box-body">  

    <?php $form = ActiveForm::begin(); ?>
    
		<div class="form-group col-lg-7 col-sm-12">
    	<?= $form->field($model, 'role_name')->textInput(['maxlength' => true])?>
		</div>
			<div class="form-group col-lg-7 col-sm-12">
    	<?= $form->field($model, 'description')->textArea(['rows' => 4])?>
		</div>
		<div class="form-group col-lg-7 col-sm-12">
    	<?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active', ], ['prompt' => 'Select Status'])?>
		</div>
		<div class="form-group col-lg-7 col-sm-12">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

    <?php ActiveForm::end(); ?>
    
    	</div>
	</div>
</div>
