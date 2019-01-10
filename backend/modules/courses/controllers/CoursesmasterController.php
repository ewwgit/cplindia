<?php

namespace backend\modules\courses\controllers;

use Yii;
use backend\modules\courses\models\CoursesMaster;
use backend\modules\courses\models\CoursesMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CoursesmasterController implements the CRUD actions for CoursesMaster model.
 */
class CoursesmasterController extends Controller
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
     * Lists all CoursesMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CoursesMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CoursesMaster model.
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
     * Creates a new CoursesMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CoursesMaster();

        if ($model->load(Yii::$app->request->post())) {
        	
        	$model->courseImage = UploadedFile::getInstance($model,'courseImage');
        	$model->attachmentUrl = UploadedFile::getInstance($model,'attachmentUrl');
        	if(!(empty($model->courseImage)))
        	{
        		$imageName = time().$model->courseImage->name;
        		$model->courseImage->saveAs('courseimages/'.$imageName );
        		$model->courseImage = 'courseimages/'.$imageName;
        	}
        	if(!(empty($model->attachmentUrl)))
        	{
        		$type=$model->attachmentUrl->type;
        		$docimg = time().$model->attachmentUrl->name;
        		$model->attachmentUrl->saveAs('coursedocs/'.$docimg );
        		$model->attachmentUrl = 'coursedocs/'.$docimg;
        		$model->fileType = $type;
        	}
       	$model->createdDate =  date("Y-m-d H:i:s");
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy = Yii::$app->user->identity->id;
        	
        	$model->save();
            return $this->redirect(['view', 'id' => $model->courseId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CoursesMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->courseId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CoursesMaster model.
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
     * Finds the CoursesMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CoursesMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CoursesMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
