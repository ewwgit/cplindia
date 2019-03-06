<?php

namespace backend\modules\courses\controllers;

use Yii;
use backend\modules\courses\models\Courses;
use backend\modules\courses\models\CoursesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\subject\models\SubjectsSearch;
use backend\modules\semisters\models\Semisters;
use common\models\User;
/**
 * CoursesController implements the CRUD actions for Courses model.
 */
class CoursesController extends Controller
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
     * Lists all Courses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CoursesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Courses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    	$searchModel = new SubjectsSearch();
    	$cinfo = Courses::find()->where(['courseId'=>$id])->one();
    $sid = $cinfo->sem_id;
    	$dataProvider = $searchModel->searchAdmin(Yii::$app->request->queryParams);
    	 
    	return $this->render('sublist', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			'courseId'=>$id,
    			'sid'=> $sid
    	]);
      
    }

    /**
     * Creates a new Courses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($sId)
    {
        $model = new Courses();
        $seminfo = Semisters::find()->where(['sem_id'=>$sId])->one();
        $model->sem_name = $seminfo->name;
        if ($model->load(Yii::$app->request->post())) {
        	$model->sem_id = $sId;
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy =  Yii::$app->user->identity->id;
        	$model->createdDate = date('Y-m-d H:i;s');
        	$model->updatedDate = date('Y-m-d H:i;s');
        	$model->save();
        	return $this->redirect(['/semisters/semisters/view', 'id' =>$sId]);
           // return $this->redirect(['view', 'id' => $model->courseId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Courses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
       $model = Courses::findOne($id);
       $sid =  $model->sem_id ;
        $seminfo = Semisters::find()->where(['sem_id'=>$model->sem_id])->one();
        $model->sem_name = $seminfo->name;
        if ($model->load(Yii::$app->request->post())) {
        	$model->sem_id =   $sid;
        	$model->updatedBy = Yii::$app->user->identity->id;
        	$model->updatedDate = date('Y-m-d H:i:s');
        	if($model->save())
        	{
        		$uinfomail = User::find()->select('email')->where('role=4')->all();
        		$umails = array();
        		foreach($uinfomail as $umail)
        		{
        			$umails[] = $umail['email'];
        		}
        		$body='Hello Fellows';
        		//	$body.=$name;
        		$body.='<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    					New Course Details are added Cpl India';
        		$body.='<br><br>Please check your account ';
        		 
        		
        		$body.='<br><br><br><u>Thanks&Regards,</u>';
        		$body.='<br>&nbsp;CPLIndia Team.';
        		
        		\Yii::$app->mailer->compose()
        		->setFrom('ngh@expertwebworx.in')
        		->setTo($umails)
        		->setSubject('Notication for New Course')
        		->setHtmlBody($body)
        		->send();
        		Yii::$app->getSession()->setFlash('success', 'Course details added successfully ');
        		return $this->redirect(['/semisters/semisters/view', 'id' =>$model->sem_id]);
        	}
        
           // return $this->redirect(['view', 'id' => $model->courseId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Courses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
    	//echo 'hello'; exit;
    	$model = Courses::findOne($id);
    	$sid =  $model->sem_id ;
        $this->findModel($id)->delete();
        return $this->redirect(['/semisters/semisters/view', 'id' =>$model->sem_id]);

        //return $this->redirect(['index']);
    }

    /**
     * Finds the Courses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Courses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Courses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
