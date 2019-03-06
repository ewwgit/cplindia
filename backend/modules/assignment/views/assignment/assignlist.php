<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\modules\semisters\models\Semisters;
use common\models\User;
use backend\modules\assignment\models\Assignment;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\assignment\models\AssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fellow Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index">
<div class="box box-primary">
<div class="box-body">



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'asId',
            //'sem_id',
        		[
        		'attribute'=>'userId',
        		'label'=>'Fellow Name',
        		'value'=>function($data){
        			$sdata = User::find()->where(['id'=>$data->userId])->one();
        			return $sdata->username;
        		}
        		],
        		[
        		'attribute'=>'sem_id',
        		'label'=>'Semister Name',
        		'value'=>function($data){
        			$sdata = Semisters::find()->where(['sem_id'=>$data->sem_id])->one();
        			return $sdata->name;
        		}
        		],
            //'asId',
            [
            'attribute'=>'asId',
            'label'=>'Assignment Name',
            'value'=>function($data){
            	$sdata = Assignment::find()->where(['asId'=>$data->asId])->one();
            	return $sdata->name;
            }
            ],
            //'description:ntext',
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
            ['class' => 'yii\grid\ActionColumn',
            'controller' => 'assignment',
            'template' => '{view} ',
            'buttons' => [
            		'view' => function ($url,$data) {
            			$url = Url::to(['/assignment/assignment/assignview','id'=>$data->asId]);
            			return Html::a(
            					'<span class="glyphicon glyphicon-eye-open"></span>',
            					$url);
            		},
            		
            
            		],
            
            		],
            //'from_date',
            //'to_date',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            //'status',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
   
</div>
</div>
</div>
