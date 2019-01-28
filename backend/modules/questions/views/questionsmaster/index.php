<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\questions\models\QuestionsMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-master-index">
<div class="box box-primary">
<div class="box-body">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Questions Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'qId',
            'quizId',
            'question:ntext',
            'status',
            'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
