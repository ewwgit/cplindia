<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\semisters\models\Semisters;
use backend\modules\courses\models\Courses;
use common\models\User;
use backend\modules\quiz\models\QuizMaster;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quiz\models\QuizMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fellow Marks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-master-index">
<div class="box box-primary">
<div class="box-body">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        		//'name',
            //'quizId',
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
       
            [
            'attribute'=>'quizId',
            'label'=>'Quiz Name',
            'value'=>function($data){
            	$cdata = QuizMaster::find()->where(['quizId'=>$data->quizId])->one();
            	return $cdata->name;
            }
            ],
            'marks', 
            'totalMarks', 
            'passMarks',
            'examDate', 
            'result'
           


           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
