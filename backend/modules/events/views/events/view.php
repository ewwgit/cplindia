<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\events\models\Events */

$this->title = $model->event_id;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="events-view">
<div class="box box-primary">
<div class="box-body"> 



    <p>
        <?= Html::a('Update', ['update', 'id' => $model->event_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->event_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'event_id',
            'event_name',
            'event_date',
            'createdBy',
            'updatedBy',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
</div>
</div>
