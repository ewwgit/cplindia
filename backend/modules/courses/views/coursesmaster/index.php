<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\courses\models\CoursesMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-master-index">

	<div class="box box-primary">
		<div class="box-body"> 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Courses Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'courseId',
            'courseName',
            'description:ntext',
            'content:ntext',
            //'courseImage:ntext',
            //'attachmentUrl:ntext',
            //'fileType',
       'status',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
