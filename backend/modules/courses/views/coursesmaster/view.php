<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\courses\models\CoursesMaster */

$this->title = $model->courseId;
$this->params['breadcrumbs'][] = ['label' => 'Courses Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="courses-master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->courseId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->courseId], [
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
            'courseId',
            'courseName',
            'description:ntext',
            'content:ntext',
            'courseImage:ntext',
            'attachmentUrl:ntext',
            'fileType',
            'status',
            'createdBy',
            'updatedBy',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
