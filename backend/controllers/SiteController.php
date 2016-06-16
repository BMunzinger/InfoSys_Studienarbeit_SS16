<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\Dozent;
use backend\models\DozentUpdateForm;
use backend\models\DozentPictureForm;
use backend\models\Authorisiertenummern;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'dozent', 'news', 'smsmessage', 'tickermessages', 'timetable', 'usergroups', 'vvs', 'edit'],
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
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays view page.
     *
     * @return mixed
     */
    public function actionDozent() {
        $query = Dozent::find()->all();

        return $this->render('dozent', ['dozents' => $query]);
    }

    public function actionNews() {
        return $this->render('news');
    }

    public function actionSmsmessage() {
        $query = Authorisiertenummern::find()->all();

        return $this->render('smsmessage', ['numbers' => $query]);
    }

    public function actionTickermessages() {
        return $this->render('tickermessages');
    }

    public function actionTimetable() {
        return $this->render('timetable');
    }

    public function actionUsergroups() {
        return $this->render('usergroups');
    }

    public function actionVvs() {
        return $this->render('vvs');
    }

    public function actionEdit($id) {

        $model = Dozent::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }

        //var_dump($model); die();
        $modelUpdate = new DozentUpdateForm();
        $modelPicture = new DozentPictureForm();





        // -----------------------------------------------------

        if ($modelPicture->load(Yii::$app->request->post())) {
            //echo "<script>console.log( 'drin' );</script>";
            //var_dump($modelPicture); die; 
            $modelPicture->picture = UploadedFile::getInstance($modelPicture, 'picture'); 
            if ($modelPicture->upload($model)) {
                return $this->refresh();
            }
        }

        // -----------------------------------------------------


            if ($modelUpdate->load(Yii::$app->request->post()) && $modelUpdate->validate()) {
                if ($modelUpdate->update($model)) {
                    Yii::$app->session->setFlash('success', 'Die Änderungen wurden erfolgreich übernommen.');
                } else {
                    Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Speichern der Daten!');
                }

                return $this->refresh();
            } else {
                return $this->render('edit', ['model' => $model, 'modelUpdate' => $modelUpdate, 'modelPicture' => $modelPicture]);
            }
        }
        public

        function actionAddnumber() {
            var_dump($numbermodel);
            die();
        }

    }
    