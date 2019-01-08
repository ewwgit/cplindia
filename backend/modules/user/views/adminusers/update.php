<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\AdminUsers */

$this->title = 'Update Admin Users: ' . $model->aduserId;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aduserId, 'url' => ['view', 'id' => $model->aduserId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-users-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    		'getimage' =>$getimage,
    ]) ?>

</div>
