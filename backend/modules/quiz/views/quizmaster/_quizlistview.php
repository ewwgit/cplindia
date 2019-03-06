<?php 
use yii\helpers\Html;
use backend\modules\semisters\models\Semisters;
use backend\modules\courses\models\Courses;

$sinfo = Semisters::find()->where(['sem_id'=>$model->sem_id])->one();
$cinfo = Courses::find()->where(['courseId'=>$model->courseId])->one();

?>

<tr>

<td data-title="Assessments"><?= $model['name']?></td>
<td data-title="Description"><?= $sinfo->name?></td>
<td data-title="Status"><?= $cinfo->name ?></td>
<td data-title="Test Cost"><strong><?= $model['validFrom']?></strong></td>
<td data-title="Action">

 

	<a href="<?php echo  Yii::$app->getUrlManager()->createUrl(['quiz/quizmaster/test','id'=>$model['quizId']])?>" class="btn btn-primary">Take A Test</a>
	
	
</td>
</tr>