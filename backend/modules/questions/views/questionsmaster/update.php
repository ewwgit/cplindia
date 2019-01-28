<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\questions\models\QuestionsMaster */

$this->title = 'Update Questions Master: ' . $model->qId;
$this->params['breadcrumbs'][] = ['label' => 'Questions Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->qId, 'url' => ['view', 'id' => $model->qId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="questions-master-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
