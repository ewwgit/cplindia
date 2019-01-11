<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\courses\models\CoursesMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courses-master-form">
	<div class="box box-primary">
		<div class="box-body"> 

    <?php $form = ActiveForm::begin(); ?>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'courseName')->textInput(['maxlength' => true]) ?>
    </div>
  <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    </div>
   <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'content')->textarea(['rows' => 3]) ?>
    </div>

    <div class="form-group col-lg-6 col-sm-12">

  <?php if($model->isNewRecord){?>
    <?= $form->field($model, 'courseImage')->fileInput(); ?>
    <?php }else {?>
    <?= $form->field($model, 'courseImage')->fileInput(); ?>
    <?PHP $image = $CoursesMaster->courseImage ;
    if(!(empty($image))){?>
    <img src="<?php echo $image; ?>" width="90" height="90" />
   <?php  }else{ ?>
   <img src="courseimage/c9ad40e3e5f6afb9e2f79688022b1cee.jpg" width="90" height="90" />
 <?php  } }?>
 </div>
 <div class="form-group col-lg-6 col-sm-12">

  <?php if($model->isNewRecord){?>
    <?= $form->field($model, 'attachmentUrl')->fileInput(); ?>
    <?php }else {?>
    <?= $form->field($model, 'attachmentUrl')->fileInput(); ?>
    <?PHP $image = $CoursesMaster->attachmentUrl ;
    if(!(empty($image))){?>
    <?php echo $image; ?>
   <?php  }else{ ?>
   <?php echo ''; ?>
 <?php  } }?>
 </div>


<div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active', ], ['prompt' => 'Select Status']) ?>
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
    height: 1px;
}
</style>
