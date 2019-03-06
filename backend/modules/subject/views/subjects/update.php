<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\subject\models\Subjects */

$this->title = 'Update Subjects: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['/courses/courses/view', 'id' => $model->courseId]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->subId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subjects-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
