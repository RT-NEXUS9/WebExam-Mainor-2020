<?php

namespace app\controllers;

use yii\web\Controller;

class MyController extends Controller{

    public function actionsIndex($id = null) {
        $hi = 'Hello, World!';
        $names = ['Ivanov', 'Petrov', 'Sidorov'];

        if(!$id) $id = 'test';

        return $this->render('index', compact('hi', 'names', 'id'));
    }

    public function actionsBlogPost()
    {
        return 'Blog Post';
    }
}