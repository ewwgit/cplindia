<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\project\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">
<div class="box box-primary">
<div class="box-body">
    <?php if(Yii::$app->user->identity->role == 1)
    {
    	?>
  
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'projectId',
            'name',
            'description:ntext',
            'from_date',
            'to_date',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php }else {?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'projectId',
            'name',
            'description:ntext',
            'from_date',
            'to_date',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            //'status',

            //['class' => 'yii\grid\ActionColumn'],
        		['class' => 'yii\grid\ActionColumn',
        		'controller' => 'project',
        		'template' => '{view} ',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/project/project/view','id'=>$data->projectId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url);
        				},
        		
        		
        				],
        				],
        ],
    ]); ?>
    <?php }?>
    
</div>
</div>
</div>
