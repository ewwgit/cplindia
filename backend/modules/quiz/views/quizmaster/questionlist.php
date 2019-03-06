<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\quiz\models\QuizMaster;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\questions\models\QuestionsMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
//print_r($quizId); exit();
?>
<div class="questions-master-index">
<div class="box box-primary">
<div class="box-body">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
  <?= Html::a('Create Questions',['/questions/questionsmaster/create','quzId'=>$quizId], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'qId',
            
            'question',
        	//'quizId',
        		[
        		'attribute'=>'quizId',
        		'label'=>'Quiz Name',
        		'value'=>function($data){
        			$sdata = QuizMaster::find()->where(['quizId'=>$data->quizId])->one();
        			return $sdata->name;
        		}
        		],
            'status',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
            'controller' => 'assessmentset',
            'buttons' => [
            		'view' => function ($url,$data) {
            			$url = Url::to(['/questions/questionsmaster/view','id'=>$data->qId]);
            			return Html::a(
            					'<span class="glyphicon glyphicon-eye-open"></span>',
            					$url);
            		},
            		'update' => function ($url,$data) {
            			$url = Url::to(['/questions/questionsmaster/update','id'=>$data->qId]);
            			return Html::a(
            					'<span class="glyphicon glyphicon-pencil"></span>',
            					$url);
            		},
            		'delete' => function ($url,$data) {
            			$url = Url::to(['/questions/questionsmaster/delete','id'=>$data->qId]);
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
