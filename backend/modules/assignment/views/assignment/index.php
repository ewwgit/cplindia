<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\modules\semisters\models\Semisters;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\assignment\models\AssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index">
<div class="box box-primary">
<div class="box-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Assignment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'asId',
            //'sem_id',
        		[
        		'attribute'=>'sem_id',
        		'label'=>'Semister Name',
        		'value'=>function($data){
        			$sdata = Semisters::find()->where(['sem_id'=>$data->sem_id])->one();
        			return $sdata->name;
        		}
        		],
            'name',
            'description:ntext',
            'attachmentUrl:ntext',
            //'from_date',
            //'to_date',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
