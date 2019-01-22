<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use  backend\modules\courses\models\Courses;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\subject\models\SubjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-index">

<div class="box box-primary">
<div class="box-body">
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
            [
            'attribute'=>'attachmentUrl',
            'label' => 'Document',
            'value'=>function($data)
            		{
            		$ccdata ='<div class="form-group"><a class="fa fa-download fa-3x" href="'.Url::to(["/subject/subjects/download","file"=>basename ($data->attachmentUrl)]).'"></a>'. basename ($data->attachmentUrl).'</div>';
            		return $ccdata;
        					},
            'format' => 'html'
            
            		],
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

           // ['class' => 'yii\grid\ActionColumn'],
        		['class' => 'yii\grid\ActionColumn',
        		'controller' => 'assessmentset',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/subject/subjects/view','id'=>$data->subId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url);
        				},
        				'update' => function ($url,$data) {
        					$url = Url::to(['/subject/subjects/update','id'=>$data->subId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-pencil"></span>',
        							$url);
        				},
        				'delete' => function ($url,$data) {
        					$url = Url::to(['/subject/subjects/delete','id'=>$data->subId]);
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
