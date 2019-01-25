<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\project\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">
<div class="box box-primary">
<div class="box-body">

   

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->projectId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->projectId], [
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
            'projectId',
            'name',
            'description:ntext',
            'from_date',
            'to_date',
            'createdBy',
            'updatedBy',
            'createdDate',
            'updatedDate',
            'status',
        ],
    ]) ?>

</div>
</div>
</div>
