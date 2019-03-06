<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\courses\models\Courses */

$this->title = 'Update Courses: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->courseId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="courses-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
