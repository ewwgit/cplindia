<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\lecture\models\GuestLectures */

$this->title = 'Update Guest Lectures: ' . $model->letureId;
$this->params['breadcrumbs'][] = ['label' => 'Guest Lectures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->letureId, 'url' => ['view', 'id' => $model->letureId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guest-lectures-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
