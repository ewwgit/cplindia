<?php

namespace backend\modules\semisters\controllers;

use yii\web\Controller;

/**
 * Default controller for the `semisters` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
