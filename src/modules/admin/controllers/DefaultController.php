<?php

namespace app\modules\admin\controllers;

use ozerich\admin\controllers\base\AdminController;

class DefaultController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}