<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\lecture\models\GuestLectures */

$this->title = 'Create Guest Lectures';
$this->params['breadcrumbs'][] = ['label' => 'Guest Lectures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-lectures-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
