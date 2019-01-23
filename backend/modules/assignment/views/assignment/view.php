<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
use yii\helpers\Url;
use backend\modules\semisters\models\Semisters;

/* @var $this yii\web\View */
/* @var $model backend\modules\assignment\models\Assignment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="assignment-view">
<div class="box box-primary">
<div class="box-body">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->asId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->asId], [
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
            'asId',
         	[
        		'attribute'=>'sem_id',
        		'label'=>'Semister Name',
        		'value'=>function($data){
        			$sdata = Semisters::find()->where(['sem_id'=>$data->sem_id])->one();
        			return $sdata->name;
        		}
        		],
            'name',
            'description:ntext',
             [
        		'attribute'=>'attachmentUrl',
        		'label' => 'Document',
        		'value'=>'<div class="form-group"><a class="fa fa-download fa-3x" href="'.Url::to(["assignment/download","file"=>basename ($model->attachmentUrl)]).'"></a>'. basename ($model->attachmentUrl).'</div>',
        		'format' => 'html'
        		],
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
