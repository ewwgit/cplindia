<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\models\AdminUsers;
use backend\modules\user\models\AdminUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


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
        $searchModel = new AdminUsersSearch();
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminUsers();
        $Usermodel = new User();
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) 
        {
        	$model->profileImage = UploadedFile::getInstance($model, 'profileImage');
        	$imageName = time().$model->profileImage->name;
        	$tempName=$model->profileImage->tempName;
        	$type=$model->profileImage->type;
        	$size=$model->profileImage->size;
        	$error=$model->profileImage->error;
        	
        	if(!(empty($model->profileImage)))
        	{
        	    $model->profileImage->saveAs('profileImage/'.$imageName);
        		$model->profileImage = 'profileImage/'.$imageName;
        	}

        	
        	
        	$Usermodel->username=$model->username;
        	$Usermodel->email=$model->email;
        	$Usermodel->password=$model->password;		
        	$Usermodel->status=10;
        	$Usermodel->created_at=Yii::$app->formatter->asDateTime('now', 'php:Y-m-d H:i:s');
            $Usermodel->save();
        	
        	$id = Yii::$app->db->getLastInsertID();
        	$model->profileImage=$imageName;
        	$model->userId=$id;
        //	$model->createdBy =Yii::$app->user->identity;
        	$model->createdDate=Yii::$app->formatter->asDateTime('now', 'php:Y-m-d H:i:s');
        	$model->save();
        	
            return $this->redirect(['view', 'id' => $model->aduserId]);
        }

        return $this->render('create', [  'model' => $model,]);
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
             $model = $this->findModel($id);
             $getimage = AdminUsers::find()->where(['aduserId'=>$id])->one();
            // print_r($getimage->profileImage);exit;
             if ($model->load(Yii::$app->request->post()) ) {
        	
        	$model->profileImage = UploadedFile::getInstance($model, 'profileImage');
        	
        	if(!(empty($model->profileImage))){
        		$name=$model->profileImage->name;
        		$tempName=$model->profileImage->tempName;
        		$type=$model->profileImage->type;
        		$size=$model->profileImage->size;
        		$error=$model->profileImage->error;
        		$model->profileImage=$name;
        		
        	}else {
        		$model->profileImage=$getimage->profileImage;
        	}
        	
            $model->update();
        	
//          $Usermodel = User::find()->where(['id'=>$model->userId])->one();
//         	$Usermodel->email=$model->email;
//         	$Usermodel->update();
        	
            return $this->redirect(['view', 'id' => $model->aduserId]);
        }

        return $this->render('update', [
            'model' => $model,
        		'getimage' => $getimage,
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
        $this->findModel($id)->delete();

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
}
