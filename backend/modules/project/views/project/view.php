<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\project\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">
<div class="box box-primary">
<div class="box-body">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'projectId',
            'name',
            'description:ntext',
            'from_date',
            'to_date',
           // 'createdBy',
           // 'updatedBy',
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
