<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\user\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-users-index">
<div class="box box-primary">
		<div class="box-body"> 

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'aduserId',
            //'userId',
            [
            		'attribute'=>'username',
            		'label'=>'User Name',
            		 'value' => function ($data) { 
    		   $userData = User::find()->where(['id' => $data->userId])->one();
    		       return $userData->username;
    		        },
            		
    ],
            'first_name',
            'last_name',
            'mobile',
            //'profileImage:ntext',
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
