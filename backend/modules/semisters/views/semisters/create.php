<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\semisters\models\Semisters */

$this->title = 'Create Semesters';
$this->params['breadcrumbs'][] = ['label' => 'Semisters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semisters-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
