<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\lecture\models\GuestLectures */

$this->title = $model->topicname;
$this->params['breadcrumbs'][] = ['label' => 'Guest Lectures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="guest-lectures-view">
<div class="box box-primary">
<div class="box-body">



    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'letureId',
            'topicname',
            'apiUrl:ntext',
        		[
        		'format' => 'raw',
        		'attribute'=>'apiUrl',
        		'label'=>'API Video',
        		'value' => !empty($model->apiUrl) ? '<iframe class="embed-responsive-item" src="'.$model->apiUrl.'" frameborder="0" allowfullscreen></iframe>' : null,
        		],
            //'speaker_id',
        		[
        		'attribute'=>'speaker_id',
        			'label'=>'Speaker Name',
        		'value'=>function($data){
        			$udata = User::find()->where(['id'=>$data->speaker_id])->one();
        			return $udata->username;
        		
        		}
        		],
         [
        		'attribute'=>'createdBy',
        				'value'=>function($data){
        				$udata = User::find()->where(['id'=>$data->createdBy])->one();
        				return $udata->username;
        				
    }
        				],
        				[
        				'attribute'=>'updatedBy',
        				'value'=>function($data){
        					$udata = User::find()->where(['id'=>$data->updatedBy])->one();
        					return $udata->username;
        				
        				}
        				],
        		
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
</div>
</div>
