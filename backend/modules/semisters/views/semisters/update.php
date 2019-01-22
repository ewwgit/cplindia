<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\semisters\models\Semisters */

$this->title = 'Update Semisters: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Semisters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->sem_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="semisters-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
