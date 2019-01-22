<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\courses\models\Courses */

$this->title = 'Create Courses';
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
