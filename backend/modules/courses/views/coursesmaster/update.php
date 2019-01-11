<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\courses\models\CoursesMaster */

$this->title = 'Update Courses Master: ' . $model->courseId;
$this->params['breadcrumbs'][] = ['label' => 'Courses Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->courseId, 'url' => ['view', 'id' => $model->courseId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="courses-master-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'CoursesMaster'=>$CoursesMaster,
    ]) ?>

</div>
