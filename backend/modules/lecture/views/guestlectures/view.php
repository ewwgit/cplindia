<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\lecture\models\GuestLectures */

$this->title = $model->letureId;
$this->params['breadcrumbs'][] = ['label' => 'Guest Lectures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="guest-lectures-view">
<div class="box box-primary">
<div class="box-body">



    <p>
        <?= Html::a('Update', ['update', 'id' => $model->letureId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->letureId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'letureId',
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
