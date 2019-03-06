<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\questions\models\QuestionsMaster */

$this->title = 'Create Questions';
$this->params['breadcrumbs'][] = ['label' => 'Questions Masters', 'url' => ['/quiz/quizmaster/view', 'id' => $model->quizId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-master-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
