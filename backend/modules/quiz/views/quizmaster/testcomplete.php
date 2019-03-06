<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use backend\modules\quiz\models\QuizMaster;
use backend\modules\semisters\models\Semisters;

/* @var $this yii\web\View */
/* @var $model app\models\UserAssessments */

//$this->title = $model->qassessmentId;
//$this->params['breadcrumbs'][] = ['label' => 'User Assessments', 'url' => ['index']];

//$this->params['breadcrumbs'][] = ['label' => 'User Assessments', 'url' => ['userassessments/index']];
$this->params['breadcrumbs'][] = $this->title;
$sinfo = Semisters::find()->where(['sem_id'=>$model->sem_id])->one();
//print_r($sinfo); exit();
//echo 'hello'; exit();
?>
<div class="user-assessments-view">
<div class="box box-primary">
<div class="box-body">

    <h1>Your Test Has Been Complete</h1>

    <div>
                      <div class="form-group">
                <div class="form-group col-lg-3 col-sm-3">Semister Name: </div><div class="form-group col-lg-8 col-sm-3"> <b>:</b> <?=$sinfo->name?></div>   
                 </div>     
                 <div class="form-group">
                <div class="form-group col-lg-3 col-sm-3">Quiz Name: </div><div class="form-group col-lg-8 col-sm-3"> <b>:</b> <?=$model->name?></div>   
                 </div>
                  <div class="form-group">
                <div class="form-group col-lg-3 col-sm-3"> Total Marks : </div> <div class="form-group col-lg-8 col-sm-3 ">: <?= $model->totalMarks?></div>   
                </div>
                <div class="form-group">
                 <div class="form-group col-lg-3 col-sm-3">Pass Marks :  </div><div class="form-group col-lg-8 col-sm-3 "> : <?= $model->passMarks?> </div>  
                </div>  
               
                 <div class="form-group">
                <div class="form-group col-lg-3 col-sm-3"> Marks Obtained: </div> <div class="form-group col-lg-8 col-sm-3 boldfont">: <?=$model->marks?></div>   
                </div>
                <div class="form-group">
                 <div class="form-group col-lg-3 col-sm-3">Result: </div><div class="form-group col-lg-8 col-sm-3 boldfont"> :  <?=$model->results?>  </div>  
                </div> 
                 
                
              
                
                  </div>

  
    

</div>
</div>
</div>
