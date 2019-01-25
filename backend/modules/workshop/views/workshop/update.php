<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\workshop\models\Workshop */

$this->title = 'Update Workshop: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Workshops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->wId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="workshop-update">

 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
