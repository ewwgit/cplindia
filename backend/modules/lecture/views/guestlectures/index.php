<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\modules\semisters\models\Semisters;
use common\models\User;
use backend\modules\user\models\AdminUsers;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\lecture\models\GuestLecturesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guest Lectures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-lectures-index">
<div class="box box-primary">
<div class="box-body">
    <?php if(Yii::$app->user->identity->role == 1)
    {
    	?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Guest Lectures', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'letureId',
        	 [
            	'attribute'=>'sem_id',
            	'label'=>'Semister Name',
            		'value'=>function($data){
            		$sdata = Semisters::find()->where(['sem_id'=>$data->sem_id])->one();
            		return $sdata->name;		
            }		
            ],
            'topicname',
            'apiUrl:ntext',
            //'speaker_id',
            [
            'attribute'=>'speaker_id',
            'label'=>'Speaker Name',
            'value'=>function($data){
            	$udata = AdminUsers::find()->where(['userId'=>$data->speaker_id])->one();
            	return $udata->first_name;
            
            }
            ],
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php }else{?>
     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'letureId',
        	 [
            	'attribute'=>'sem_id',
            	'label'=>'Semister Name',
            		'value'=>function($data){
            		$sdata = Semisters::find()->where(['sem_id'=>$data->sem_id])->one();
            		return $sdata->name;		
            }		
            ],
            'topicname',
            'apiUrl:ntext',
            //'speaker_id',
            [
            'attribute'=>'speaker_id',
            'label'=>'Speaker Name',
            'value'=>function($data){
            	$udata = User::find()->where(['id'=>$data->speaker_id])->one();
            	return $udata->username;
            
            }
            ],
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
            'controller' => 'guestlectures',
            'template' => '{view}',
            'buttons' => [
            		'view' => function ($url,$data) {
            			$url = Url::to(['/lecture/guestlectures/view','id'=>$data->letureId]);
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
