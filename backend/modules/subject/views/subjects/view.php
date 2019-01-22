<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\subject\models\Subjects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subjects-view">
<div class="box box-primary">
<div class="box-body">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->subId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->subId], [
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
            'subId',
            'name',
            'description',
          [
        		'attribute'=>'attachmentUrl',
        		'label' => 'Document',
        		'value'=>'<div class="form-group"><a class="fa fa-download fa-3x" href="'.Url::to(["subjects/download","file"=>basename ($model->attachmentUrl)]).'"></a>'. basename ($model->attachmentUrl).'</div>',
        		'format' => 'html'
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
        		
            //'createdBy',
            //'updatedBy',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
</div>
</div>
