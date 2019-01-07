<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\AdminUsers */

$this->title = 'Create Admin Users';
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-users-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
