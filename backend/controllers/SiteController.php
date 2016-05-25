<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\Dozent;
use common\models\Dozentfach;
use yii\web\NotFoundHttpException;

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
                        'actions' => ['logout', 'index', 'dozent', 'view', 'dozentfach', 'edit'],
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
    
    public function actionDozentfach() {
        $query = Dozentfach::find()->all();

        return $this->render('dozentfach', ['dozentfächer' => $query]);
    }
    

    public function actionEdit($id) {
        $model = Dozentfach::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('edit', [
                    'model' => $model,
        ]);
    }

}
