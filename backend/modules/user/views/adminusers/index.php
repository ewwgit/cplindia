<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\User;
use yii\helpers\ArrayHelper;
use app\modules\roles\models\Roles;
use backend\modules\user\models\AdminUsers;

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
        		
       [
        		'attribute'=>'first_name',
        		'label'=>'First Name',
       		'value'=>function ($data) { 
    		   $fData = AdminUsers::find()->where(['userId' => $data->id])->one();
    		       return $fData->first_name;
    		        },		
       		],
            'username',
            'email',
        		[
        		'attribute'=>'role',
        		'label'=>'Role',
        		'filter'=> Html::activeDropDownList($searchModel, 'role',ArrayHelper::map(Roles::find()->select(['roleId','role_name'])->where(('roleId > 1'))->asArray()->all(), 'roleId', 'role_name'),['class'=>'form-control','prompt'=>'Select Role']),
        		'value' => function ($data) { 
    		   $roleData = Roles::find()->where(['roleId' => $data->role])->one();
    		       return $roleData->role_name;
    		        },		
        		],
        		[
        		'attribute'=>'status',
        		'label'=>'Status',
        		'filter' => Html::activeDropDownList($searchModel, 'status', ['10' => 'Active','0' => 'In-active'],['class'=>'form-control','prompt' => 'Status']),
        		'value' => function($data)
        				{
        			if($data->status == 10)
        			{
        				$status = 'Active';
        			 }
        			else
        			{
        				$status = 'In-Active';
        			}
        			return $status;
        		}
        		],
           
          
            //'address2:ntext',
            //'landmark:ntext',
            //'contactMobile',
            //'adminUserImageUrl:ntext',
            //'adminSignatureUrl:ntext',
            //'country',
            //'state',
            //'city',
            //'countryName',
            //'stateName',
            //'createdBy',
            //'updatedBy',
            //'createdDate',
            //'updatedDate',

            ['class' => 'yii\grid\ActionColumn',
            		'template'=>'{view} {update} {delete} {password}',
            		'buttons' => [
            		'password' => function ($url,$data) {
            				$url = Url::to(['/user/adminusers/reset-password','id'=>$data->id]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-lock"></span>',
            						$url,['title'=>'Reset Password']);
            				},
            		
            			],	
        		],
        ],
    ]); ?>
</div>
</div>
</div>
