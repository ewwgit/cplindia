<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\questions\models\QuestionsMaster;
use backend\modules\quiz\models\QuizMaster;

/* @var $this yii\web\View */
/* @var $model backend\modules\questions\models\QuestionsMaster */

$this->title = $model->question;
$this->params['breadcrumbs'][] = ['label' => 'Questions Masters', 'url' => ['/quiz/quizmaster/view', 'id' => $model->quizId]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="questions-master-view">
<div class="box box-primary">
<div class="box-body">



    <p>
        <?= Html::a('Update', ['update', 'id' => $model->qId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->qId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
     <?php $options =  QuestionsMaster::getOptions($model->qId);
        $answers =  QuestionsMaster::getAnswers($model->qId);
        $answersData = '';
        foreach ($answers as $ans)
        {
        	$answersData.= $ans['answerText'].'<br />';
        }
       // print_r($options['0']['options']);exit();
        ?>

              <?= DetailView::widget([
        'model' => $model,
              	
        'attributes' => [
        		
            'qId',
           [
        		'attribute'=>'quizId',
        		'value'=>function($data)
        				{
        					
        				$qdata = QuizMaster::find()->where(['quizId'=>$data->quizId])->one();
        				//print_r($qdata); exit;
        				return $qdata->name;
        				}
        		],
            'question:ntext',
        		[
        		'attribute'=>'optionsOne',
        		'value'=>$options['0']['options']
        		],
        		[
        		'attribute'=>'optionsTwo',
        		'value'=>$options['1']['options']
        		],
        		[
        		'attribute'=>'optionsThree',
        		'value'=>$options['2']['options']
        		],
        		[
        		'attribute'=>'optionsFour',
        		'value'=>$options['3']['options']
        		],
        	
        	
        		[
        		'attribute'=>'answers',
        		'format' => 'html',
        		'value'=>$answersData
        		],
        	//'name:ntext',
            'status',
            'createdBy',
            'updatedBy',
            'createdDate',
            'updatedDate',
            'ipAddress',
        ],
    ]) ?>

</div>
</div>
</div>
