<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\roles\models\Roles */

$this->title = 'Update Roles: ' . $model->role_name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->roleId, 'url' => ['view', 'id' => $model->roleId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roles-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
