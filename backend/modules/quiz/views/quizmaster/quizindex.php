<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\semisters\models\Semisters;
use  backend\modules\courses\models\Courses;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quiz\models\QuizMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quiz Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-master-index">

<div class="box box-primary">
<div class="box-body">

    
    <div class="box">
						<div class="box-body table-responsive no-padding">
							<div id="no-more-tables">
								<table class="table table-bordered table-striped table-condensed cf custom_tables">
									<thead class="cf">
									<tr>
										
										<th width="30%">Quiz Name</th>
										<th>Semister Name</th>
										<th>Course Name</th>
										<th>Date</th>
										<th width="10%">Action</th>
									</tr>
									</thead>
									<tbody>
									<?php 
									 echo ListView::widget( [
											'dataProvider' => $dataProvider,
											'itemView' => '_quizlistview',
									] ); 
									?>  
																	 
								  </tbody>
								</table>
							</div><!-- /.box-body -->
							
							
							
						</div>
					</div>
				


</div>
</div>
</div>

