<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use SebastianBergmann\CodeCoverage\Report\PHP;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\AdminUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-users-form">
<div class="box box-primary">
<div class="box-body"> 

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>

 
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    </div>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
    </div>
    <?php if(yii::$app->controller->action->id == 'create'){?>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'password')->passwordInput()?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'confirmpassword')->passwordInput()?>
    </div>
    <?php }?>

<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    </div>


<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'role')->dropdownList($model->roles,['prompt'=>'Select Role']);?>
    </div>
     <?php if(yii::$app->controller->action->id == 'create'){?>
    <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'profileImage')->fileInput(); ?>
    </div>
    <?php }else{?>
       <div class="form-group col-lg-6 col-sm-12">
    	<img class='image' src="<?php if($model->profileImage){
	echo isset( $model->profileImage)? Url::base().'/'.$model->profileImage : '' ;
	
		
	}else {
	echo "profileImage/user-iconnew.png" ;
								     }
								?>"
			width="100" height="100">

			  <?= $form->field($model, 'profileImage')->fileInput(); ?>
			  </div>
			  <?php }?>
  <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'status')->dropdownList(['10'=>'Active','0'=>'In-active'],['prompt'=>'Select Status']);?>
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
