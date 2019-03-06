<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\models\AdminUsers;
use backend\modules\user\models\AdminUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\roles\models\Roles;
use app\models\SignupAdminuser;
use app\models\UserMainSearch;
use yii\helpers\ArrayHelper;
use backend\models\ChangePasswordForm;


use yii\web\UploadedFile;
use common\models\User;

/**
 * AdminusersController implements the CRUD actions for AdminUsers model.
 */
class AdminusersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdminUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
         $searchModel = new UserMainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        
    	
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        		
        ]);
    }

    /**
     * Displays a single AdminUsers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = new SignupAdminuser();
    	$admininfo = User::find()->where(['id' => $id])->one();
    	
       if(!empty($admininfo))
        {
        	$model->username = $admininfo->username;
        	$model->email = $admininfo->email;
        	$model->status = $admininfo->status;
     
        $roleName = Roles::find()->select('role_name')->where(['roleId' => $admininfo->role])->one();
    		//print_r($roleName);exit();
    		$datas = ArrayHelper::toArray($roleName, ['role_name']);
    		$data=implode($datas);
    		$model->role = $data;
        	$model->id = $admininfo->id;
        	//print_r($admininfo->id);exit();
        	$adminuser = AdminUsers::find()->where(['userId' => $admininfo->id])->one();
        	//print_r($adminuser);exit();
        }
        if(!empty($adminuser))
        {
        	$model->first_name = $adminuser->first_name;
        	$model->last_name = $adminuser->last_name;
        	$model->mobile = $adminuser->mobile;
        	$model->profileImage = $adminuser->profileImage;
        	//print_r($model->profileImage); exit();
        	
        
        	$model->createdBy = $adminuser->createdBy;
        	$model->updatedBy = $adminuser->updatedBy;
        	$model->createdDate = $adminuser->createdDate;
        	$model->updatedDate = $adminuser->updatedDate;
       
        	
        }
    	
    	
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new AdminUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$model = new SignupAdminuser();
    	$adminuser = new AdminUsers();
    	$model->scenario = 'create';
    	$rolesd = $model->getAllRoles();
    	$model->roles = $rolesd;
    	
    	
    	if ($model->load(Yii::$app->request->post())) {
    		 
    	
    		$model->profileImage = UploadedFile::getInstance($model,'profileImage');
    		
    		 
    		if($model->validate())
    		{
    			//print_r($model->first_name);exit();
    			$user = $model->signup();
    			$adminuser->userId = $user->id;
    			$adminuser->first_name = $model->first_name;
    			$adminuser->last_name = $model->last_name;
    			$adminuser->mobile= $model->mobile;
    			
    			if(!empty($model->profileImage))
    			{
    				$imageName = time().$model->profileImage->name;
    				$model->profileImage->saveAs('profileImage/'.$imageName );
    				$model->profileImage = 'profileImage/'.$imageName;
    				$adminuser->profileImage = $model->profileImage;
    				 
    			}
    
    	

    			$adminuser->createdDate =  date("Y-m-d H:i:s");
    			$adminuser->updatedDate = date('Y-m-d H:i:s');
    			$adminuser->createdBy = Yii::$app->user->identity->id;
    			$adminuser->updatedBy = Yii::$app->user->identity->id;
    			
    	
    			$adminuser->save();
    			Yii::$app->session->setFlash('success', " Adminuser Created successfully ");
    			return $this->redirect(['index']);
    	
    		}
    		else{
    			//print_r($model->errors); exit();
    			return $this->render('create', [
    					'model' => $model,
    			]);
    		}
    		//return $this->redirect(['view', 'id' => $model->aduserId]);
    	}
    	
    	else {
    		 
    		 
    	
    		return $this->render('create', [
    				'model' => $model,
    		]);
    	}
    }

    /**
     * Updates an existing AdminUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
             $model = new SignupAdminuser();
        //$adminuser = new AdminUsers();
        $admininfo = User::find()->where(['id' => $id])->one();
        
        if(!empty($admininfo))
        {
        	$model->username = $admininfo->username;
        	$model->email = $admininfo->email;
        	$model->status = $admininfo->status;
        	$model->role = $admininfo->role;
        	$model->id = $admininfo->id;
        
        	$adminuser = AdminUsers::find()->where(['userId' => $admininfo->id])->one();
        	
        }
        if(!empty($adminuser))
        {
        	$model->first_name = $adminuser->first_name;
        	$model->last_name = $adminuser->last_name;
        	$model->mobile = $adminuser->mobile;
        	$model->profileImage = $adminuser->profileImage;	
        }
        
        

        if ($model->load(Yii::$app->request->post()) ) {
        	
        	if($model->validate())
        	{
        	//print_r($model); exit();
        	$model->profileImage = UploadedFile::getInstance($model,'profileImage');
        
        	
        		$admininfo->username = $model->username;
        		$admininfo->email = $model->email;
        		$admininfo->status = $model->status ;
        		$admininfo->role = $model->role ;
        		
        		$admininfo->update();
        		$adminuser->first_name = $model->first_name;
        	    //print_r($adminuser->first_name);exit();
        		$adminuser->last_name = $model->last_name;
        		//print_r($adminuser->last_name);exit();
        		$adminuser->mobile = $model->mobile;

        		
        		
        		if(!empty($model->profileImage))
        		{
        			$imageName = time().$model->profileImage->name;
        			$model->profileImage->saveAs('profileImage/'.$imageName );
        			$model->profileImage = 'profileImage/'.$imageName;
        			$adminuser->profileImage = $model->profileImage;
        			 
        		}
        		
        		
        	     $adminuser->save();
        		
        		
        		Yii::$app->session->setFlash('success', " Adminuser Updated successfully ");
        		
        		return $this->redirect(['index']);
        	}
        	else{
        		$model->errors;
        	}
        		
        		
        		
        		//return $this->redirect(['view', 'id' => $model->aduserId]);
        	
        	
        	
          
        }
        $rolesd = $model->getAllRoles();
        $model->roles = $rolesd;
     
      

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdminUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       try{
    		//$model = $this->findModel($id)->delete();
        	$aduserinfo = User::find()->where(['id' => $id])->one();
        	$aduserinfo->status ='In-active';
        	$aduserinfo->update();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted admin user.');
    		
    	}
    	
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Admin user is not deleted.');
    		
    	}
    	
    	return $this->redirect(['index']);
    }

    /**
     * Finds the AdminUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUsers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionResetPassword($id)
    {
    
    	try {
    		$model = new ChangePasswordForm();
    	} catch (InvalidParamException $e) {
    		throw new BadRequestHttpException($e->getMessage());
    	}
    
    	if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword($id)) {
    		$userinfo = User::find()->where(['id' => $id])->one();
    		$username = $userinfo->username;
    		$uemail = $userinfo->email;
    		$newpassword = $model->password;
    		//$body='Username:'.$username. + ''.'NewPassword:' .$newpassword;
    		//print_r($username);
    		//print_r($newpassword);exit();
    
    
    		$body='Hi &nbsp;&nbsp;';
    		$body.=$username;
    		$body.='<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				Your UserName is:'.$username;
    		$body.='<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your NewPassword is:' .$newpassword;
    
    		$body.='<br><br><br><u>Thanks&Regards,</u>';
    		$body.='<br>&nbsp;NGH Admin.';
    
    		\Yii::$app->mailer->compose()
    		->setFrom('ngh@expertwebworx.in')
    		->setTo($uemail)
    		->setSubject('You Have Received a New Message on ' . \Yii::$app->name)
    		->setHtmlBody($body)
    		->send();
    
    		Yii::$app->getSession()->setFlash('success', 'New password was saved.');
    
    		return $this->redirect(['index']);;
    	}
    	return $this->render('resetPassword', [
    			'model' => $model,
    	]);
    }
}
