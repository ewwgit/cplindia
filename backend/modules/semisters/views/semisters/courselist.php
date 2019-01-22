<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\modules\semisters\models\Semisters;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\courses\models\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">
<div class="box box-primary">
<div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Courses', ['/courses/courses/create','sId'=>$semid], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'courseId',
            [
            	'attribute'=>'sem_id',
            	'label'=>'Semister Name',
            		'value'=>function($data){
            		$sdata = Semisters::find()->where(['sem_id'=>$data->sem_id])->one();
            		return $sdata->name;		
            }		
            ],
            //'sem_id',
            'name',
            'description:ntext',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            'status',

           
        	 	['class' => 'yii\grid\ActionColumn',
        		'controller' => 'courses',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/courses/courses/view','id'=>$data->courseId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url);
        				},
        				'update' => function ($url,$data) {
        					$url = Url::to(['/courses/courses/update','id'=>$data->courseId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-pencil"></span>',
        							$url);
        				},
        				'delete' => function ($url,$data) {
        					$url = Url::to(['/courses/courses/delete','id'=>$data->courseId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-trash"></span>',
        							$url,['data-confirm' => "Are you sure you want to delete this chapter?", 'data-method'=>"post"]);
        				},
        		
        				],
        				], 
        ],
    ]); ?>
</div>
</div>
</div>