<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\assignment\models\Assignment */

$this->title = 'Update Assignment: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->asId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assignment-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
