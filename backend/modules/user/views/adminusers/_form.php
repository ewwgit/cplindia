<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use SebastianBergmann\CodeCoverage\Report\PHP;

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
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    </div>
    
    <?php if($model->isNewRecord){?>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    </div>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
    </div>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'password')->passwordInput()?>
    </div>
<?php } ?>
<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'profileImage')->fileInput(); ?>
    <?PHP $image = $getimage->profileImage ;
    if(!(empty($image))){?>
    <img src="profileImage/<?php echo $image; ?>" width="150" height="150" />
   <?php  }else{ ?>
   <img src="profileImage/c9ad40e3e5f6afb9e2f79688022b1cee.jpg" width="150" height="150" />
 <?php   }?>
  
  
  
    </div>



<div class="form-group col-lg-6 col-sm-12">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
