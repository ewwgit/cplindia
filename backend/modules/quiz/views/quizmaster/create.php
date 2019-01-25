<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quiz\models\QuizMaster */

$this->title = 'Create Quiz Master';
$this->params['breadcrumbs'][] = ['label' => 'Quiz Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-master-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
