<?php

namespace app\controllers;

use Yii;
use \yii\base\HttpException;
use yii\web\Controller;
use app\models\Authors;
use app\models\Magazins;
use app\models\MagazinsAuthors;

class AuthorsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        $post = new Authors;
        $data = $post->find()->all();
        echo $this->render('index', array(
            'data' => $data
        ));
    }


    /**
     * Вывод конкретного Автора
     * @param null $id
     */
    public function actionRead($id=NULL)
    {
        if ($id === NULL)
            throw new HttpException(404, 'Not Found');

        $post = Authors::find()->where(['id'=>$id])
            ->one();

        if ($post === NULL)
            throw new HttpException(404, 'Document Does Not Exist');

        echo $this->render('read', array(
            'post' => $post
        ));
    }

    /**
     * Удаление Автора
     * @param null $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id=NULL)
    {
        if ($id === NULL)
        {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('site/index'));
        }

        $post = Authors::find()
            ->where(['id'=>$id])
            ->one();


        if ($post === NULL)
        {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('site/index'));
        }

        $post->delete();

        Yii::$app->session->setFlash('PostDeleted');
        Yii::$app->getResponse()->redirect(array('authors/index'));
    }

    /**
     * Добавление Автора
     */
    public function actionCreate()
    {
        $model = new Authors();
        if (isset($_POST['Authors']))
        {
            $model->name = $_POST['Authors']['name'];
            $model->second_name = $_POST['Authors']['second_name'];
            $model->third_name = $_POST['Authors']['third_name'];

            if ($model->save())
                Yii::$app->response->redirect(array('site/read', 'id' => $model->id));
        }

        echo $this->render('create', array(
            'model' => $model
        ));
    }


    /**
     * Редактирование информации об Авторе
     * @param null $id
     */
    public function actionUpdate($id=NULL)
    {
        if ($id === NULL)
            throw new HttpException(404, 'Not Found');

        $model = Authors::find()
            ->where(['id'=>$id])
            ->one();

        if ($model === NULL)
            throw new HttpException(404, 'Document Does Not Exist');

        if (isset($_POST['Authors']))
        {
            $model->name = $_POST['Authors']['name'];
            $model->second_name = $_POST['Authors']['second_name'];
            $model->third_name = $_POST['Authors']['third_name'];

            if ($model->save())
                Yii::$app->response->redirect(array('site/read', 'id' => $model->id));
        }

        echo $this->render('create', array(
            'model' => $model
        ));
    }

}
