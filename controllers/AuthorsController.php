<?php

namespace app\controllers;

use phpDocumentor\Reflection\DocBlock\Tags\Author;
use Yii;
use \yii\base\HttpException;
use yii\web\Controller;
use app\models\Authors;
use yii\data\Pagination;

class AuthorsController extends Controller
{

    public function actionIndex()
    {
        $data = Authors::find();
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 5]);
        $data = $data->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', array(
            'data' => $data,
            'pages' => $pages,
        ));
    }


    /**
     * Вывод конкретного Автора
     * Вместе со списком принадлежащих ему журналов
     * @param null $id
     */
    public function actionRead($id = NULL)
    {
        if ($id === NULL)
            throw new HttpException(404, 'Not Found');

        $post = Authors::find()
            ->where(['id' => $id])
            ->one();

        $magazins = $post
            ->getMagazinsAuthors()
            ->joinWith('mag', 'aut')
            ->all();

        if ($post === NULL)
            throw new HttpException(404, 'Document Does Not Exist');

        return $this->render('read', array(
            'post' => $post,
            'magazins' => $magazins
        ));
    }

    /**
     * Удаление Автора
     * @param null $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id = NULL)
    {
        if ($id === NULL) {
            Yii::$app
                ->session
                ->setFlash('PostDeletedError');
            Yii::$app
                ->getResponse()
                ->redirect(array('site/index'));
        }

        $post = Authors::find()
            ->where(['id' => $id])
            ->one();


        if ($post === NULL) {
            Yii::$app
                ->session
                ->setFlash('PostDeletedError');
            Yii::$app
                ->getResponse()
                ->redirect(array('site/index'));
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
        if (Yii::$app->request->isPjax) {
            $post = \Yii::$app->request->post();
            $model->name = $post['Authors']['name'];
            $model->second_name = $post['Authors']['second_name'];
            $model->third_name = $post['Authors']['third_name'];
            if ($model->save()) {
                Yii::$app->session->setFlash('AuthorsCreateSuccess');
            } else {
                Yii::$app->session->setFlash('AuthorsCreateError');
            }
        }

        return $this->render('create', array(
            'model' => $model
        ));
    }


    /**
     * Редактирование информации об Авторе
     * @param null $id
     */
    public function actionUpdate($id = NULL)
    {
        if ($id === NULL)
            throw new HttpException(404, 'Not Found');

        $model = Authors::find()
            ->where(['id' => $id])
            ->one();

        if ($model === NULL)
            throw new HttpException(404, 'Document Does Not Exist');

        if (Yii::$app->request->isPjax) {
            $post = \Yii::$app->request->post();
            $model->name = $post['Authors']['name'];
            $model->second_name = $post['Authors']['second_name'];
            $model->third_name = $post['Authors']['third_name'];
            if ($model->save()) {
                Yii::$app->session->setFlash('AuthorsUpdateSuccess');
            } else {
                Yii::$app->session->setFlash('AuthorsUpdateError');
            }

        }

        return $this->render('create', array(
            'model' => $model
        ));
    }

}
