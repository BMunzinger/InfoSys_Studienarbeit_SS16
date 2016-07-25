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
use common\models\Kursplan;
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
                        'actions' => ['logout', 'index', 'dozent', 'news', 'smsmessage', 'tickermessages', 'timetable', 'timetableview', 'updateevent', 'deleteevent', 'usergroups', 'vvs', 'edit'],
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

    public function actionTimetable($kurs) {
        $newEntry = new Kursplan();

        $q = Kursplan::find()->joinWith('dozent', 'fach')->where(['Semester' => $kurs])->all();

        $events = [];
        foreach ($q as $e) {
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
                    break;
            }
            $event = new \common\models\Event();
            $event->id = $e->ID;
            $event->title = $e->fach['Name'] . "\r\n" . $e->Raum . "\r\n" . $e->dozent['Name'] . ' ' . $e->dozent['Vorname'];
            $event->start = $e->ZeitVon;
            $event->end = $e->ZeitBis;
            $event->dow = [$weekday];
            $event->editable = true;
            $event->className = 'event-' . $e->ID;

            $events[] = $event;
        }

        if ($newEntry->load(Yii::$app->request->post()) && $newEntry->validate()) {

            switch ($_POST['Kursplan']['Wochentag']) {
                case 0: $weekday = 'Montag';
                    break;
                case 1: $weekday = 'Dienstag';
                    break;
                case 2: $weekday = 'Mittwoch';
                    break;
                case 3: $weekday = 'Donnerstag';
                    break;
                case 4: $weekday = 'Freitag';
                    break;
                default: break;
            }

            $newEntry->Dozent = $_POST['Kursplan']['Dozent'];
            $newEntry->Fach = $_POST['Kursplan']['Fach'];
            $newEntry->Raum = $_POST['Kursplan']['Raum'];
            $newEntry->ZeitVon = $_POST['Kursplan']['ZeitVon'];
            $newEntry->ZeitBis = $_POST['Kursplan']['ZeitBis'];
            $newEntry->Wochentag = $weekday;
            $newEntry->Semester = $kurs;

            if ($newEntry->save())
                Yii::$app->response->redirect(array('site/timetable'));
            return $this->refresh();
        }

        return $this->render('timetable', ['kurs' => $kurs, 'events' => $events, 'q' => $q, 'newEntry' => $newEntry]);
    }

    public function actionTimetableview() {
        $newEntry = new Kursplan();

        $query = Kursplan::find()->orderBy('Semester')->select('Semester')->distinct()->all();
        if ($query === null) {
            throw new NotFoundHttpException;
        }

        if ($newEntry->load(Yii::$app->request->post())) {
            foreach ($query as $q) {
                if ($_POST['Kursplan']['Semester'] === $q->Semester) {
                        Yii::$app->session->setFlash('error', 'Kurs ist bereits vorhanden!');
                    return $this->refresh();
                }
            }
            $newEntry->Semester = $_POST['Kursplan']['Semester'];
            $newEntry->ZeitVon = '7:35';
            $newEntry->ZeitBis = '9:05';
            $newEntry->Wochentag = 'Montag';
            if ($newEntry->save())
                Yii::$app->response->redirect(array('site/timetableview'));
            return $this->refresh();
        }

        return $this->render('timetableview', [
                    'kursplan' => $query, 'newEntry' => $newEntry
        ]);
    }

    public function actionUpdateevent() {
        $model = Kursplan::findOne($_POST['Kursplan']['ID']);

        switch ($_POST['Kursplan']['Wochentag']) {
            case 0: $weekday = 'Montag';
                break;
            case 1: $weekday = 'Dienstag';
                break;
            case 2: $weekday = 'Mittwoch';
                break;
            case 3: $weekday = 'Donnerstag';
                break;
            case 4: $weekday = 'Freitag';
                break;
            default: break;
        }

        switch ($_POST['Kursplan']['ZeitVon']) {
            case 0: $zeitvon = '7:30';
                break;
            case 1: $zeitvon = '9:30';
                break;
            case 2: $zeitvon = '11:15';
                break;
            case 3: $zeitvon = '14:00';
                break;
            case 4: $zeitvon = '15:45';
                break;
            case 5: $zeitvon = '17:30';
                break;
            default: break;
        }

        switch ($_POST['Kursplan']['ZeitBis']) {
            case 0: $zeitbis = '9:05';
                break;
            case 1: $zeitbis = '11:00';
                break;
            case 2: $zeitbis = '12:45';
                break;
            case 3: $zeitbis = '15:30';
                break;
            case 4: $zeitbis = '17:15';
                break;
            case 5: $zeitbis = '19:00';
                break;
            default: break;
        }

        $model->Fach = $_POST['Kursplan']['Fach'];
        $model->Dozent = $_POST['Kursplan']['Dozent'];
        $model->Raum = $_POST['Kursplan']['Raum'];
        $model->ZeitVon = $zeitvon;
        $model->ZeitBis = $zeitbis;
        $model->Wochentag = $weekday;

        $model->update();
        return $this->redirect(['/site/timetable', 'kurs' => $_POST['Kursplan']['Semester']]);
    }

    public function actionDeleteevent() {
        $model = Kursplan::findOne($_POST['Kursplan']['ID']);

        $model->delete();

        return $this->redirect(['/site/timetable', 'kurs' => $_POST['Kursplan']['Semester']]);
    }

//    public function actionDrop($blub) {
//        var_dump($blub);
//    }

    public function actionUsergroups() {
        return $this->render('usergroups');
    }

    public function actionVvs() {
        $query = Vvs::find()->all();
        return $this->render('vvs', ['items' => $query]);
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
