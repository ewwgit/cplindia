<?php

namespace backend\modules\semisters\controllers;

use Yii;
use backend\modules\semisters\models\Semisters;
use backend\modules\semisters\models\SemistersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\courses\models\CoursesSearch;

/**
 * SemistersController implements the CRUD actions for Semisters model.
 */
class SemistersController extends Controller
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
     * Lists all Semisters models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SemistersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Semisters model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   

    /**
     * Creates a new Semisters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Semisters();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	$model->from_date = date('Y-m-d', strtotime($model->from_date));
        	$model->to_date = date('Y-m-d', strtotime($model->to_date));
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy = Yii::$app->user->identity->id;
        	$model->createdDate = date('Y-m-d H:i:s');
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Semisters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
        	$model->updatedBy = Yii::$app->user->identity->id;
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Semisters model.
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
     * Finds the Semisters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Semisters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Semisters::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionView($id)
    {
    	$searchModel = new CoursesSearch();
    	$dataProvider = $searchModel->searchAdmin(Yii::$app->request->queryParams);
    	
    	return $this->render('courselist', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    			'semid'=>$id
    	]);
    	
    }
}
