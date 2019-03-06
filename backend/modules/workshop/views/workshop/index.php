<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\workshop\models\WorkshopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workshops';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-index">
<div class="box box-primary">
<div class="box-body"> 
    <?php if(Yii::$app->user->identity->role == 1)
    {
    	?>

  
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Workshop', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'wId',
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

            //'wId',
            'name',
            'description:ntext',
            'from_date',
            'to_date',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',
            //'status',

           // ['class' => 'yii\grid\ActionColumn'],
        		['class' => 'yii\grid\ActionColumn',
        		'controller' => 'workshop',
        		'template' => '{view} ',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/workshop/workshop/view','id'=>$data->wId]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url);
        				},
        		
        		
        				],
        				],
        ],
    ]); ?>
    <?php }?>
</div>
</div>
</div>
