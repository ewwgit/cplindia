<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\questions\models\QuestionsMaster */

$this->title = 'Create Questions Master';
$this->params['breadcrumbs'][] = ['label' => 'Questions Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-master-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
