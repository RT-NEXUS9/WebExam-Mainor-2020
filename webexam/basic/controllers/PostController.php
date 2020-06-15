<?php
namespace app\controllers;

use app\models\Category;
use Yii;
use app\models\TestForm;


class PostController extends AppController{

    public $layout = 'basic';

    public function beforeAction($action)
    {
        if ($action->id == 'index' ) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex(){
        if ( Yii::$app->request->isAjax){
            debug(Yii::$app->request->post());
            return 'test';
        }

        $post = TestForm::findOne(4);
 //       $post->email = 'robert.chaykin@mail.ru';
 //       $post->save();

//        $post->delete();

        $model = new TestForm();
        /*$model->name = 'Автор';
//        $model->email = 'mail@mail.com';
        $model->text = 'Текст сообщения';
        $model->save();*/


        if( $model->load(Yii::$app->request->post()) ){
            if ($model->save() ){
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        $this->view->title = 'Все статьи!';
        return $this->render('test', compact('model'));

    }

    public function actionShow() {
        $this->view->title = 'Одна статья!';
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => 'ключевики...']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'описание страницы...']);

        $cats = Category::find()->with('products')->all();

        return $this->render('show', compact('cats'));
    }

}