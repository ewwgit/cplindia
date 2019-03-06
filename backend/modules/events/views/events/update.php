<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\events\models\Events */

$this->title = 'Update Events: ' . $model->event_id;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->event_id, 'url' => ['view', 'id' => $model->event_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="events-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
