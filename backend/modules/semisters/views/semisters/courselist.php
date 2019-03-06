<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\modules\semisters\models\Semisters;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\courses\models\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = ['label' => 'Semisters', 'url' => ['index']];
$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">
<div class="box box-primary">
<div class="box-body">
    <?php if(Yii::$app->user->identity->role == 1)
    {
    	?>
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
        		'attribute'=>'name',
        		'label'=>'Course Name',
        		],
            [
            	'attribute'=>'sem_id',
            	'label'=>'Semester Name',
            		'value'=>function($data){
            		$sdata = Semisters::find()->where(['sem_id'=>$data->sem_id])->one();
            		return $sdata->name;		
            }		
            ],
            //'sem_id',

            //'name',
            'description:ntext',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            'status',

           
        	 	['class' => 'yii\grid\ActionColumn',
        		'controller' => 'courses',
        	 	'template' => '{view} {update} {delete}',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/courses/courses/view','id'=>$data->courseId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url,['title' => 'courses view',]);
        				},
        				'update' => function ($url,$data) {
        					$url = Url::to(['/courses/courses/update','id'=>$data->courseId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-pencil"></span>',
        							$url,[
                        'title' => 'update']);
        				},
        				'delete' => function ($url,$data) {
        					$url = Url::to(['/courses/courses/delete','id'=>$data->courseId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-trash"></span>',
        							$url,['data-confirm' => "Are you sure you want to delete this course?", 'data-method'=>"post",'title'=>'delete']);
        				},
        		
        				],
        				], 
        ],
    ]); ?>
      <?php }else {?>
       <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'courseId',
        		[
        		'attribute'=>'name',
        		'label'=>'Course Name',
        		],
            [
            	'attribute'=>'sem_id',
            	'label'=>'Semister Name',
            		'value'=>function($data){
            		$sdata = Semisters::find()->where(['sem_id'=>$data->sem_id])->one();
            		return $sdata->name;		
            }		
            ],
            //'sem_id',

            //'name',
            'description:ntext',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            'status',

           
        	 	['class' => 'yii\grid\ActionColumn',
        		'controller' => 'courses',
        	 	'template' => '{view}',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/courses/courses/view','id'=>$data->courseId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url,[ // to prevent breaking table on hover
                        'title' => 'courses view',]);
        				},
        				
        		
        				],
        				], 
        ],
    ]); ?>
    <?php }?>
</div>
</div>
</div>