<?php

namespace backend\modules\subject\controllers;

use Yii;
use backend\modules\subject\models\Subjects;
use backend\modules\subject\models\SubjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;

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
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) ) {
        	
        	$model->attachmentUrl = UploadedFile::getInstance($model,'attachmentUrl');
        	if(!(empty($model->attachmentUrl)))
        	{
        		$type=$model->attachmentUrl->type;
        		$docurl = time().$model->attachmentUrl->name;
        		$model->attachmentUrl->saveAs('coursedocs/'.$docurl );
        		$model->attachmentUrl = $docurl;
        		$model->fileType = $type;
        	}
        	 $model->courseId = $cId;
        	 $model->createdBy = Yii::$app->user->identity->id;
        	 $model->updatedBy = Yii::$app->user->identity->id;
        	 $model->createdDate = date('Y-m-d H:i:s');
        	 $model->updatedDate = date('Y-m-d H:i:s');
        	 $model->save();
        	 
            return $this->redirect(['view', 'id' => $model->subId]);
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
        $model = $this->findModel($id);
       $updateddoc = $model->attachmentUrl;

        if ($model->load(Yii::$app->request->post()) ) {
        	$model->attachmentUrl = UploadedFile::getInstance($model,'attachmentUrl');
        	if(!(empty($model->attachmentUrl)))
        	{
        		$type=$model->attachmentUrl->type;
        		$docurl = time().$model->attachmentUrl->name;
        		$model->attachmentUrl->saveAs('coursedocs/'.$docurl );
        		$model->attachmentUrl = $docurl;
        		$model->fileType = $type;
        	}
        	else{
        		$model->attachmentUrl = $updateddoc;
        	}
        	$model->updatedBy = Yii::$app->user->identity->id;
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->save();
            return $this->redirect(['view', 'id' => $model->subId]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
