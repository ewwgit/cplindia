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

    <?php if(Yii::$app->user->identity->role == 1)
    {
    	?>

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
    <?php }else{?>
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
            [
            'attribute'=>'attachmentUrl',
            'label' => 'Assignment Document',
            'value'=>function($data)
            		{
            		$aview='<div class="form-group"><a class="fa fa-download fa-3x" href="'.Url::to(["assignment/download","file"=>basename ($data->attachmentUrl)]).'"></a>'. basename ($data->attachmentUrl).'</div>';
            		return $aview;
            		},
            'format' => 'html'
            		],
            //'attachmentUrl:ntext',
            //'from_date',
            //'to_date',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            //'status',

           // ['class' => 'yii\grid\ActionColumn'],
        		['class' => 'yii\grid\ActionColumn',
        		'controller' => 'assignment',
        		'template' => '{view},{userupload} ',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/assignment/assignment/view','id'=>$data->asId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url);
        				},
        				'userupload' => function ($url,$data) {
        				$url = Url::to(['/assignment/assignment/assignupload','aid'=>$data->asId]);
        				return Html::a(
        						'<span class="glyphicon glyphicon-pencil"></span>',
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
