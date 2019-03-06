<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\events\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-index">
<div class="box box-primary">
<div class="box-body"> 

      <?php if(Yii::$app->user->identity->role == 1)
    {
    	?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Events', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php }?>
     <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
  )); ?>
</div>
</div>
</div>
