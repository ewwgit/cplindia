<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\courses\models\CoursesMaster */

$this->title = 'Create Courses Master';
$this->params['breadcrumbs'][] = ['label' => 'Courses Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-master-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
