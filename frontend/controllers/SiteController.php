<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\Dozent;
use common\models\Menu_item;
use common\models\Vvs;
use common\models\Newsdaily;
use common\models\Fach;
use common\models\Kursplan;
use common\models\Newsrss;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Tickermeldungen;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
     * @inheritdoc
     */
    public function actions() {
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
     * @return mixed
     */
    public function actionIndex() {
        $model = Newsdaily::find()->all();
        return $this->render('index', ['model' => $model]);
        //return $this->render('index');
    }

    public function actionVvs() {
        $query = Vvs::find()->all();
        return $this->render('vvs', ['items' => $query]);
    }

    public function actionVvsview($id) {
        $model = Vvs::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }
        return $this->render('vvsview', [
                    'vvs' => $model,
        ]);
    }
    
    /**
     * Logs in a user.
     *
     * @return mixed
     */
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionNews() {
        
        $query = Newsrss::find()->all();
        
        return $this->render('news', ['news' => $query]);
    }

    public function actionDozent() {
        $query = Dozent::find()->all();
        return $this->render('dozent', ['dozents' => $query]);
    }

    public function actionDozentview($id) {
        $model = Dozent::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }
        return $this->render('dozentview', [
                    'dozent' => $model,
        ]);
    }

    public function actionTiles() {
        //console.log("actionTiles");
        $model = Menu_item::find()->where(['backend_only' => 0])->all();
        if ($model === null) {
            throw new NotFoundHttpException;
        }
        return $this->render('tiles', ['model' => $model]);
    }

    public function actionKursplanview() {
        $query = Kursplan::find()->orderBy('Semester')->select('Semester')->distinct()->all();
        if ($query === null) {
            throw new NotFoundHttpException;
        }
        return $this->render('kursplanview', [
                    'kursplan' => $query,
        ]);
    }

    public function actionKursplan($kurs) {
        $query = Kursplan::find()->joinWith('dozent', 'fach')->where(['Semester' => $kurs])->all();

        $events = [];
        foreach ($query as $e) {
            switch ($e->Wochentag) {
                case 'Montag': $weekday = 1;
                    break;
                case 'Dienstag': $weekday = 2;
                    break;
                case 'Mittwoch': $weekday = 3;
                    break;
                case 'Donnerstag': $weekday = 4;
                    break;
                case 'Freitag': $weekday = 5;
                    break;
                case 'Samstag': $weekday = 6;
                    break;
                case 'Sonntag': $weekday = 7;
                    break;
                default: $weekday = 0;
            }
            $event = new \common\models\Event();
            $event->id = $e->ID;
            $event->title = $e->fach['Name'] . "\r\n" . $e->Raum . "\r\n" . $e->dozent['Vorname'] . ' ' . $e->dozent['Name'];
            $event->start = $e->ZeitVon;
            $event->end = $e->ZeitBis;
            $event->dow = [$weekday];
            $events[] = $event;
        }

        return $this->render('kursplan', [ 'kurs' => $kurs, 'events' => $events]);
    }
    
}
