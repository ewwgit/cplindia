<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\roles\models\Roles;


/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\AdminUsers */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="admin-users-view">

   <div class="box box-primary">
		<div class="box-body"> 

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->aduserId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->aduserId], [
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
        //    'aduserId',
           // 'userId',
            'first_name',
            'last_name',
            'mobile',
        		'username',
        		'email',
        		'role',
          // 'profileImage:ntext',
        		
        		[
        		'attribute'=>'profileImage',
        		'value'=> $model->profileImage,
        		'format' => ['image',['width'=>'90','height'=>'90']],
        		],
         	[
        		'attribute' => 'createdBy',
        	
        		'value' =>  Roles::getUsername($model->createdBy),
        		],
        		[
        		'attribute' => 'updatedBy',
        		 
        		'value' =>  Roles::getUsername($model->updatedBy),
        		],
        		[
        		'attribute' => 'createdDate',
        		
        		'format' =>  ['date', 'php:d/m/Y H:i:s'],
        		],
        		[
        				'attribute' => 'updatedDate',
        		
        				'format' =>  ['date', 'php:d/m/Y H:i:s'],
        		],
            //'createdDate',
            //'updatedDate',
        ],
    ]) ?>

</div>
</div>
</div>
