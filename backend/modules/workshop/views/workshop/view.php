<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\workshop\models\Workshop */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Workshops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="workshop-view">
<div class="box box-primary">
<div class="box-body"> 

    

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->wId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->wId], [
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
            'wId',
            'name',
            'description:ntext',
            'from_date',
            'to_date',
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
            'status',
        ],
    ]) ?>

</div>
</div>
</div>
