<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\quiz\models\QuizMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-master-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'quizId') ?>

    <?= $form->field($model, 'sem_id') ?>

    <?= $form->field($model, 'courseId') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'validFrom') ?>

    <?php // echo $form->field($model, 'validTime') ?>

    <?php // echo $form->field($model, 'quizTime') ?>

    <?php // echo $form->field($model, 'totalMarks') ?>

    <?php // echo $form->field($model, 'passMarks') ?>

    <?php // echo $form->field($model, 'eachquestioncarries') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'updatedBy') ?>

    <?php // echo $form->field($model, 'createdDate') ?>

    <?php // echo $form->field($model, 'updatedDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
