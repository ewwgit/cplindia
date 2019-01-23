<?php

namespace backend\modules\lecture\controllers;

use Yii;
use backend\modules\lecture\models\GuestLectures;
use backend\modules\lecture\models\GuestLecturesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\semisters\models\Semisters;
use backend\modules\courses\models\Courses;
use common\models\User;

/**
 * GuestlecturesController implements the CRUD actions for GuestLectures model.
 */
class GuestlecturesController extends Controller
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
     * Lists all GuestLectures models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GuestLecturesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GuestLectures model.
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
     * Creates a new GuestLectures model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GuestLectures();
        $semisters = Semisters::find()->select('sem_id,name')->all();
        $semister =array();
        for($k=0;$k<count($semisters);$k++)
        {
        	//$hospital['Prompt'] = 'Select Hospital Name';
        	$semister[$semisters[$k]['sem_id']] = $semisters[$k]['name'];
        }
        $model->semname = $semister;
        $spdata = User::find()->where('role=3')->all();
        $speaker = array();
        for($j=0;$j<count($spdata);$j++)
        {
        	//$hospital['Prompt'] = 'Select Hospital Name';
        	$speaker[$spdata[$j]['id']] = $spdata[$j]['username'];
        }
        $model->spname = $speaker;   
        if ($model->load(Yii::$app->request->post()) ) {
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy =  Yii::$app->user->identity->id;
        	$model->createdDate = date('Y-m-d H:i;s');
        	$model->updatedDate = date('Y-m-d H:i;s');
        	 $model->save();
            return $this->redirect(['view', 'id' => $model->letureId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GuestLectures model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->letureId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GuestLectures model.
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
     * Finds the GuestLectures model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GuestLectures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GuestLectures::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
   
}
