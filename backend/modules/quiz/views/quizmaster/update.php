<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quiz\models\QuizMaster */

$this->title = 'Update Quiz Master: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quiz Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->quizId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="quiz-master-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
