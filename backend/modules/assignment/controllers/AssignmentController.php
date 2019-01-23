<?php

namespace backend\modules\assignment\controllers;

use Yii;
use backend\modules\assignment\models\Assignment;
use backend\modules\assignment\models\AssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\semisters\models\Semisters;
use yii\web\UploadedFile;

/**
 * AssignmentController implements the CRUD actions for Assignment model.
 */
class AssignmentController extends Controller
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
     * Lists all Assignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Assignment model.
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
     * Creates a new Assignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Assignment();
        $semisters = Semisters::find()->select('sem_id,name')->all();
        $semister =array();
        for($k=0;$k<count($semisters);$k++)
        {
        	//$hospital['Prompt'] = 'Select Hospital Name';
        	$semister[$semisters[$k]['sem_id']] = $semisters[$k]['name'];
        }
        $model->semname = $semister;

        if ($model->load(Yii::$app->request->post())) {
        	$model->attachmentUrl = UploadedFile::getInstance($model,'attachmentUrl');
        	if(!(empty($model->attachmentUrl)))
        	{
        		$type=$model->attachmentUrl->type;
        		$docurl = time().$model->attachmentUrl->name;
        		$model->attachmentUrl->saveAs('assigndocs/'.$docurl );
        		$model->attachmentUrl = $docurl;
        		$model->fileType = $type;
        	}
        	$model->from_date = date('Y-m-d', strtotime($model->from_date));
        	$model->to_date = date('Y-m-d', strtotime($model->to_date));
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy =  Yii::$app->user->identity->id;
        	$model->createdDate = date('Y-m-d H:i;s');
        	$model->updatedDate = date('Y-m-d H:i;s');
        	 $model->save();
            return $this->redirect(['view', 'id' => $model->asId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Assignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Assignment model.
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
     * Finds the Assignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Assignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assignment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionDownload($file) {
    
    
    	$path = Yii::getAlias('@app')."/web/assigndocs/".$file;
    	//print_r($path);exit();
    	$this->downloadFile($path,$file);
    }
    public function downloadFile($fullpath,$file){
    	if(!empty($fullpath)){
    
    		header("Content-type:application/pdf"); //for pdf file
    		//header('Content-Type:text/plain; charset=ISO-8859-15');
    		//if you want to read text file using text/plain header
    		header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    		header('Content-Disposition: attachment; filename="'.$file.'"');
    		header('Content-Length: ' . filesize($fullpath));
    		readfile($fullpath);
    		Yii::app()->end();
    	}
    }
}
