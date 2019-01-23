<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\modules\semisters\models\Semisters;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\lecture\models\GuestLecturesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guest Lectures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-lectures-index">
<div class="box box-primary">
<div class="box-body">


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
            	$udata = User::find()->where(['id'=>$data->speaker_id])->one();
            	return $udata->username;
            
            }
            ],
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
