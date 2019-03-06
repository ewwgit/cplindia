<?php

namespace backend\modules\subject\controllers;

use Yii;
use backend\modules\subject\models\Subjects;
use backend\modules\courses\models\Courses;
use backend\modules\subject\models\SubjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
use backend\modules\subject\models\SubjectsDocuments;
use backend\modules\semisters\models\Semisters;
use common\models\User;


/**
 * SubjectsController implements the CRUD actions for Subjects model.
 */
class SubjectsController extends Controller
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
     * Lists all Subjects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subjects model.
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
     * Creates a new Subjects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cId)
    {
        $model = new Subjects();
        //$model->scenario = 'create';
       // $model->courseId = $cId;
        $couseinfo = Courses::find()->where(['courseId'=>$cId])->one();
        $seminfo =Semisters::find()->where(['sem_id'=>$couseinfo->sem_id])->one();
        $model->sem_name = $seminfo->name;
        $model->course_name = $couseinfo->name;

        if ($model->load(Yii::$app->request->post()) ) {
        	 $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
        	
        	 $model->courseId = $cId;
        	 $model->createdBy = Yii::$app->user->identity->id;
        	 $model->updatedBy = Yii::$app->user->identity->id;
        	 $model->createdDate = date('Y-m-d H:i:s');
        	 $model->updatedDate = date('Y-m-d H:i:s');
        	 if($model->save()){
        	 	$model->upload();
        	 	$uinfomail = User::find()->select('email')->where('role=4')->all();
        	 	$umails = array();
        	 	foreach($uinfomail as $umail)
        	 	{
        	 		$umails[] = $umail['email'];
        	 	}
        	 	$body='Hello Fellows';
        	 	//	$body.=$name;
        	 	$body.='<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    					New Subject Details are added Cpl India';
        	 	$body.='<br><br>Please check your account ';
        	 	 
        	 	
        	 	$body.='<br><br><br><u>Thanks&Regards,</u>';
        	 	$body.='<br>&nbsp;CPLIndia Team.';
        	 	
        	 	\Yii::$app->mailer->compose()
        	 	->setFrom('ngh@expertwebworx.in')
        	 	->setTo($umails)
        	 	->setSubject('Notication for New Subject')
        	 	->setHtmlBody($body)
        	 	->send();
        	 	Yii::$app->getSession()->setFlash('success', 'Subject details added successfully ');
        	  return $this->redirect(['/courses/courses/view', 'id' => $model->courseId]);
        	 }
        	 
           
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Subjects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model =  Subjects::findOne($id);
        $cid = $model->courseId;
        
        $couseinfo = Courses::find()->where(['courseId'=>$model->courseId])->one();
        $seminfo =Semisters::find()->where(['sem_id'=>$couseinfo->sem_id])->one();
        $model->sem_name = $seminfo->name;
        $model->course_name = $couseinfo->name;
        //$model->courseId = $model->courseId;
       //$updateddoc = $model->attachmentUrl;

        if ($model->load(Yii::$app->request->post()) ) {
        	$model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
        	$model->courseId =  $cid;
        	$model->updatedBy = Yii::$app->user->identity->id;
        	$model->updatedDate = date('Y-m-d H:i:s');
        	if($model->save())
        	{
        		$model->upload();
        	}
            return $this->redirect(['/courses/courses/view', 'id' => $model->courseId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Subjects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
    	$model =  Subjects::findOne($id);
    	$cid = $model->courseId;
        $this->findModel($id)->delete();
        return $this->redirect(['/courses/courses/view', 'id' => $model->courseId]);

       // return $this->redirect(['index']);
    }

    public function actionDownload($file) {
    	 
    	 
    	$path = Yii::getAlias('@app')."/web/coursedocs/".$file;
    	//print_r($path);exit();
    	$this->downloadFile($path,$file);
    }
    public function downloadFile($fullpath,$file){
    	if(!empty($fullpath)){
    
    		header("Content-type:application/pdf"); //for pdf file
    		//header('Content-Type:text/plain; charset=ISO-8859-15');
    		//if you want to read text file using text/plain header
    		//header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    		header('Content-Disposition: attachment; filename="'.$file.'"');
    		header('Content-Length: ' . filesize($fullpath));
    		readfile($fullpath);
    		Yii::app()->end();
    	}
    }
    /**
     * Finds the Subjects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subjects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subjects::findOne($id)) !== null) {
        	$documenturl = SubjectsDocuments::find()->where(['subId'=>$model->subId])->all();
        	$model->subdocurl = $documenturl;
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
