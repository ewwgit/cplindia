<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use  backend\modules\courses\models\Courses;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\subject\models\SubjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['/semisters/semisters/view','id'=>$sid]];
$this->title = 'Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-index">

<div class="box box-primary">
<div class="box-body">
    <?php if(Yii::$app->user->identity->role == 1)
    {
    	?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Subjects', ['/subject/subjects/create','cId'=>$courseId], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'subId',
        		[
        		'attribute'=>'courseId',
        		'label'=>'Course Name',
        		'value'=>function($data){
        			$cdata = Courses::find()->where(['courseId'=>$data->courseId])->one();
        			return $cdata->name;
        		}
        		],
        		[
        				'attribute'=>'name',
        				'label'=>'Subject Name',
        		],
        		//'courseId',
           // 'name',
            'description',
           // 'attachmentUrl:ntext',
          
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

           // ['class' => 'yii\grid\ActionColumn'],
        		['class' => 'yii\grid\ActionColumn',
        		'controller' => 'subject',
        		//'header'=>'Subjects View',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/subject/subjects/view','id'=>$data->subId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url,[ 
                        'title' => 'view',]);
        				},
        				'update' => function ($url,$data) {
        					$url = Url::to(['/subject/subjects/update','id'=>$data->subId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-pencil"></span>',
        							$url,[
                        'title' => 'update',]);
        				},
        				'delete' => function ($url,$data) {
        					$url = Url::to(['/subject/subjects/delete','id'=>$data->subId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-trash"></span>',
        							$url,['data-confirm' => "Are you sure you want to delete this subject?", 'data-method'=>"post",'title'=>'delete']);
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

            //'subId',
        		[
        		'attribute'=>'courseId',
        		'label'=>'Course Name',
        		'value'=>function($data){
        			$cdata = Courses::find()->where(['courseId'=>$data->courseId])->one();
        			return $cdata->name;
        		}
        		],
        		[
        				'attribute'=>'name',
        				'label'=>'Subject Name',
        		],
        		//'courseId',
           // 'name',
            'description',
           // 'attachmentUrl:ntext',
          
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

           // ['class' => 'yii\grid\ActionColumn'],
        		['class' => 'yii\grid\ActionColumn',
        		'controller' => 'subjects',
        		//'header'=>'Subjects View',
        		'template' => '{view}',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/subject/subjects/view','id'=>$data->subId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url,[// to prevent breaking table on hover
                        'title' => 'subjects view',]);
        				},
        				
        		
        				],
        				],
        ],
    ]); ?>
    <?php }?>
      
</div>
</div>
</div>
