<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\roles\models\Roles;

/* @var $this yii\web\View */
/* @var $model app\modules\roles\models\Roles */

$this->title = $model->role_name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-view">
	<div class="box box-primary">
		<div class="box-body">  

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->roleId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->roleId], [
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
            'roleId',
            'role_name',
            'status',
            //'createdBy',
        		[
        		'attribute' => 'createdBy',
        	
        		'value' =>  Roles::getUsername($model->createdBy),
        		],
        		[
        		'attribute' => 'updatedBy',
        		 
        		'value' =>  Roles::getUsername($model->updatedBy),
        		],
            //'updatedBy',
            [
        		'attribute' => 'createdDate',
        		
        		'format' =>  ['date', 'php:d/m/Y H:i:s'],
        		],
        		[
        		'attribute' => 'updatedDate',
        		
        		'format' =>  ['date', 'php:d/m/Y H:i:s'],
        		],
        ],
    ]) ?>
</div>
</div>
</div>
