<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\semisters\models\SemistersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Semesters';
$this->params['breadcrumbs'][] = $this->title;
//echo Yii::$app->user->identity->role; exit();
?>
<div class="semisters-index">
<div class="box box-primary">
<div class="box-body"> 

    <?php if(Yii::$app->user->identity->role == 1)
    {
    	?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Semesters', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'sem_id',
            'name',
            'description:ntext',
            'from_date',
            'to_date',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            //'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php }else {?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'sem_id',
            'name',
            'description:ntext',
            'from_date',
            'to_date',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            //'status',
        		['class' => 'yii\grid\ActionColumn',
        		'template' => '{view}',
        		//'header'=>'Courses View',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/semisters/semisters/view','id'=>$data->sem_id]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url,[// to prevent breaking table on hover
                        'title' => 'semisters view']);
        				},
        				
        		
        				],
        				],
            
        ],
    ]); ?>
    <?php }?>
</div>
</div>
</div>
