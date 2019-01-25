<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\quiz\models\QuizMaster */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quiz Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-master-view">
<div class="box box-primary">
<div class="box-body">

    

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->quizId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->quizId], [
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
            'quizId',
            'sem_id',
            'courseId',
            'name',
            'description:ntext',
            'validFrom',
            'validTime',
            'quizTime',
            'totalMarks',
            'passMarks',
            'eachquestioncarries',
            'status',
            'createdBy',
            'updatedBy',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
</div>
</div>
