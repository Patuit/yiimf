<?php

namespace app\controllers;

use Yii;
use \yii\base\HttpException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Magazins;
use app\models\Authors;
use app\models\MagazinsAuthors;
use app\models\UploadImage;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Magazins::find()->all();

        $authors = [];
        foreach ($data as $key => $item) {
            if ($item->getMagazinsAuthors()->with('aut')->all()) {
                foreach ($item->getMagazinsAuthors()->with('aut')->all() as $keyAuthors => $author) {
                    $authors[$key] .=
                        " " . $data[$key]->getMagazinsAuthors()->with('aut')->all()[$keyAuthors]->aut->name . " " .
                        $data[$key]->getMagazinsAuthors()->with('aut')->all()[$keyAuthors]->aut->second_name . ",";
                }
                $authors[$key] = substr($authors[$key], 0, -1);
                $authors[$key] = $authors[$key] . ".";
            }
            $answer[] = $item;
        }

        echo $this->render('index', array(
            'data' => $answer,
            'authors' => $authors,
        ));
    }

    public function actionRead($id = NULL)
    {
        if ($id === NULL)
            throw new HttpException(404, 'Not Found');

        $magazinsModel = Magazins::find()
            ->where(['id' => $id])
            ->one();

        $authorsModel = $magazinsModel
            ->getMagazinsAuthors()
            ->joinWith('mag', 'aut')
            ->all();

        // Формируется строка авторов
        foreach ($authorsModel as $author) {
            $authorsArr[] = $author->aut->name . " " . $author->aut->second_name;
        }
        $authorsStr = implode(', ', $authorsArr) . '.';

        if ($magazinsModel === NULL)
            throw new HttpException(404, 'Document Does Not Exist');

        echo $this->render('read', array(
            'post' => $magazinsModel,
            'authors' => $authorsStr,
        ));
    }

    public function actionDelete($id = NULL)
    {
        if ($id === NULL) {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('site/index'));
        }

        $post = Magazins::find()
            ->where(['id' => $id])
            ->one();

        if ($post === NULL) {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('site/index'));
        }

        $post->delete();

        Yii::$app->session->setFlash('PostDeleted');
        Yii::$app->getResponse()->redirect(array('site/index'));
    }

    public function actionCreate()
    {
        $imageModel = new UploadImage();
        if (Yii::$app->request->isPost) {
            $imageModel->image = UploadedFile::getInstance($imageModel, 'image');
            $imageModel->upload();
        }

        $model = new Magazins();
        $authors = new Authors();
        $magazinsAuthors = new MagazinsAuthors();
        if (isset($_POST['Magazins'])) {
            $model->title = $_POST['Magazins']['title'];
            $model->description = $_POST['Magazins']['description'];
            $model->image = $imageModel->image->name;
            $model->date = $_POST['Magazins']['date'];
            $model->save();
            if ($model->save()) {
                $lastIdMagazins = $model->id;

                $magazinsAuthorsArray = [];
                foreach ($_POST['Authors']['id'] as $item) {
                    $magazinsAuthorsArray[] = [$lastIdMagazins, $item];
                }
                Yii::$app->db->createCommand()->batchInsert($magazinsAuthors->tableName(), ['id_mag', 'id_aut'], $magazinsAuthorsArray)->execute();

//                Yii::$app->response->redirect(array('site/read', 'id' => $model->id));
            }

        }

        echo $this->render('create', array(
            'model' => $model,
            'authors' => $authors,
            'imageModel' => $imageModel,
        ));
    }


    public function actionUpdate($id = NULL)
    {
        $imageModel = new UploadImage();
        if (Yii::$app->request->isPost) {
            $imageModel->image = UploadedFile::getInstance($imageModel, 'image');
            $imageModel->upload();
        }

        if ($id === NULL)
            throw new HttpException(404, 'Not Found');

        $model = Magazins::find()->where(['id' => $id])->one();
        $authorsModel = $model->getMagazinsAuthors()->with('aut')->all();
        foreach ($authorsModel as $item) {
            $authors[$item->aut->id] = $item->aut->name;
        }
        if ($authors)
            $authorsArray = array_keys($authors);

        if ($model === NULL)
            throw new HttpException(404, 'Document Does Not Exist');

        if (isset($_POST['Magazins'])) {
            $model->title = $_POST['Magazins']['title'];
            $model->description = $_POST['Magazins']['description'];
            $model->image = $imageModel->image->name;
            $model->date = $_POST['Magazins']['date'];
            $model->save();
            if ($model->save()) {
                $magazinsAuthors = MagazinsAuthors::find();
                // Выбираем id последней записи MagazinsAuthors
                $lastIdMagazins = MagazinsAuthors::find()->orderBy(['id' => SORT_DESC])->offset(1)->one();
                if ($authors === NULL) {
                    // Если журналу не соответвует ни один автор
                    foreach ($_POST['Authors']['id'] as $item) {
                        $magazinsAuthors = new MagazinsAuthors();
                        $magazinsAuthors->id_aut = $item;
                        $magazinsAuthors->id_mag = $id;
                        $magazinsAuthors->save();
                    }
                } else {
                    $countNewAuthors = count($_POST['Authors']['id']);
                    $countOldAuthors = count($authorsArray);
                    $removeAuthors = array_diff($authorsArray, $_POST['Authors']['id']);
                    $addAuthors = array_diff($_POST['Authors']['id'], $authorsArray);
                    foreach ($addAuthors as $item) {
                        $addMagazinsAuthorsArray[] = [$lastIdMagazins + 1, $item];
                    }

                    // Если количество изменяемых авторов одинаковое
                    if ($countNewAuthors === $countOldAuthors) {
                        foreach ($removeAuthors as $key => $item) {
                            $save = $magazinsAuthors->where(['id_mag' => $id])->one();
                            $save->id_aut = $addAuthors[$key];
                            $save->save();
                        }
                    }

                    // Если количество выбранных новых авторов меньше, чем старых
                    if ($countNewAuthors < $countOldAuthors) {
                        foreach ($removeAuthors as $key => $item) {
                            $save = $magazinsAuthors->where(['id_mag' => $id])->andWhere(['id_aut' => $item])->one();
                            $save->delete();
                        }
                    }

                    // Если количество выбранных новых авторов больше, чем старых
                    if ($countNewAuthors > $countOldAuthors) {
                        foreach ($addAuthors as $key => $item) {
                            $magazinsAuthors = new MagazinsAuthors();
                            $magazinsAuthors->id_aut = $item;
                            $magazinsAuthors->id_mag = $id;
                            $magazinsAuthors->save();
                        }
                    }
                }

                Yii::$app->response->redirect(array('site/read', 'id' => $model->id));
            }
        }
        $authors = new Authors();
        echo $this->render('create', array(
            'model' => $model,
            'authors' => $authors,
            'authorsArray' => $authorsArray,
            'imageModel' => $imageModel,
        ));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
