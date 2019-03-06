<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\User;
use backend\modules\courses\models\Courses;

/* @var $this yii\web\View */
/* @var $model backend\modules\subject\models\Subjects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['/courses/courses/view', 'id' => $model->courseId]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subjects-view">
<div class="box box-primary">
<div class="box-body">
    <?php if(Yii::$app->user->identity->role == 1)
    {
    	?>

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
    <?php }?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'subId',
        		[
        		'attribute'=>'courseId',
        		'label'=>'Course Name',
        		'value'=>function($data){
        			$udata = Courses::find()->where(['courseId'=>$data->courseId])->one();
        			return $udata->name;
        		
        		}
        		],
            //'courseId',
            'name',
            'description',
      
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
    <h3>Documents</h3>
        		 <?php if(!(empty($model->subdocurl))){
    	?>
    	<div>Documents:</div>
    	<?php 
   foreach ($model->subdocurl as $keys => $documents)
   {
   	
   ?>
    <div class="form-group"><a class="fa fa-download fa-3x" href="<?= Url::to(["subjects/download","file"=>basename ($documents->attachmentUrl)]) ?>"></a><?= basename ($documents->attachmentUrl) ?></div>
    <?php 
   }
   } ?>

</div>
</div>
</div>
