<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\workshop\models\Workshop */

$this->title = 'Create Workshop';
$this->params['breadcrumbs'][] = ['label' => 'Workshops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
