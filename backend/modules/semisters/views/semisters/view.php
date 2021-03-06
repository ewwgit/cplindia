<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\semisters\models\Semisters */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Semisters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="semisters-view">
<div class="box box-primary">
<div class="box-body"> 
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->sem_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->sem_id], [
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
           // 'sem_id',
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
            //'createdBy',
            //'updatedBy',
            'createdDate',
            'updatedDate',
            'status',
        ],
    ]) ?>

</div>
</div>
</div>
