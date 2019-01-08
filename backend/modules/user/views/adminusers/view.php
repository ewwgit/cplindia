<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\AdminUsers */

$this->title = $model->aduserId;
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
            'userId',
            'first_name',
            'last_name',
            'mobile',
           //'profileImage:ntext',
        		
        		[
        		'attribute'=>'profileImage',
        		'value'=> 'profileImage/'.$model->profileImage,
        		'format' => ['image',['width'=>'100','height'=>'100']],
        		],
          //  'createdBy',
         //   'updatedBy',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
</div>
</div>
