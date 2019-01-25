<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quiz\models\QuizMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quiz Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-master-index">
<div class="box box-primary">
<div class="box-body">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Quiz Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'quizId',
            'sem_id',
            'courseId',
            'name',
            'description:ntext',
            //'validFrom',
            //'validTime',
            //'quizTime',
            //'totalMarks',
            //'passMarks',
            //'eachquestioncarries',
            //'status',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
