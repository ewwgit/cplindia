<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
use yii\helpers\Url;
use backend\modules\semisters\models\Semisters;
use backend\modules\assignment\models\Assignment;

/* @var $this yii\web\View */
/* @var $model backend\modules\assignment\models\Assignment */

//$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="assignment-view">
<div class="box box-primary">
<div class="box-body">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'asId',
        		[
        		'attribute'=>'asId',
        		'label'=>'Assignment Name',
        		'value'=>function($data){
        			$sdata = Assignment::find()->where(['asId'=>$data->asId])->one();
        			return $sdata->name;
        		}
        		],
        		[
        		'attribute'=>'userId',
        		'label'=>'Fellow Name',
        		'value'=>function($data){
        			$udata = User::find()->where(['id'=>$data->userId])->one();
        			return $udata->username;
        		
        		}
        		],
         	[
        		'attribute'=>'sem_id',
        		'label'=>'Semister Name',
        		'value'=>function($data){
        			$sdata = Semisters::find()->where(['sem_id'=>$data->sem_id])->one();
        			return $sdata->name;
        		}
        		],
            //'name',
            //'description:ntext',
             [
        		'attribute'=>'attachmentUrl',
        		'label' => 'Document',
        		'value'=>'<div class="form-group"><a class="fa fa-download fa-3x" href="'.Url::to(["assignment/download","file"=>basename ($model->attachmentUrl)]).'"></a>'. basename ($model->attachmentUrl).'</div>',
        		'format' => 'html'
        		],
            'uploadedDate',
            
            
        ],
    ]) ?>

</div>
</div>
</div>
