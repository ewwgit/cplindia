<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\roles\models\RolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="box box-primary">
		<div class="box-body">  
    <p>
        <?= Html::a('Create Roles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'roleId',
            'role_name',
        		'description',
            'status',
            //'createdBy',
            //'udpatedBy',
            //'createdDate',
            //'updatedDate',


        		['class' => 'yii\grid\ActionColumn',
        		'header'=>'Actions',
        		'headerOptions'=>['style'=>'color:#3c8dbc'],
        		'template' => '{view} {update}',
        		'buttons' => [
        			
        		],
        		
        		],
        ],
    ]); ?>
    </div>
    </div>
</div>
