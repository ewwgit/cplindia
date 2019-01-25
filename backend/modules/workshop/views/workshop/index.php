<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\workshop\models\WorkshopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workshops';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-index">
<div class="box box-primary">
<div class="box-body"> 

  
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
</div>
</div>
</div>
