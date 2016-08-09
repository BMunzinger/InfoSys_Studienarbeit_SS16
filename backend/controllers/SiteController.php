<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\Dozent;
use common\models\Vvs;
use backend\models\Vvsform;
use backend\models\DozentUpdateForm;
use backend\models\DozentPictureForm;
use common\models\Kursplan;
use backend\models\DozentPictureUpdateForm;
use backend\models\Authorisiertenummern;
use backend\models\AuthorisiertenummernForm;
use common\models\Newsrss;
use backend\models\NewsrssUpdate;
use common\models\Newsdaily;
use backend\models\NewsdailyForm;
use common\models\Tickermeldungen;
use backend\models\TickermeldungenForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\models\Fach;
use backend\models\KursUpdateForm;

Yii::setAlias('@front', 'http://front.dev');

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
                        'actions' => ['logout', 'index', 'dozent', 'news', 'newsupdate', 'usergroups',
                            'timetable', 'timetable', 'timetableview', 'updateevent', 'deleteevent',
                            'vvs', 'vvsadd', 'vvsupload', 'vvsedit', 'vvsdelete',
                            'tickermessages', 'addticker', 'editticker', 'deleteticker',
                            'dailys', 'adddaily', 'deletedaily', 'editdaily',
                            'smsmessage', 'addnumber', 'removenumber', 'editnumber',
                            'newdozent', 'editdozent', 'editdozentpicture', 'removedozent',
                            'kurs', 'newkurs', 'editkurs', 'removekurs'],
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
    public function actionDailys() {
        $query = Newsdaily::find()->orderBy('day')->all();

        return $this->render('dailys', ['messages' => $query]);
    }

    public function actionAdddaily() {
        $addDaily = new NewsdailyForm();
        $addDaily->id = 0;
        $addDaily->day = $_POST['NewsdailyForm']['day'];
        $addDaily->message = $_POST['NewsdailyForm']['message'];

        if ($addDaily->addDaily()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde erstellt!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Speichern der Daten!');
        }

        return $this->redirect(['dailys']);
    }

    public function actionDeletedaily() {
        $deleteDaily = new NewsdailyForm();
        $deleteDaily->id = $_POST['NewsdailyForm']['id'];
        ;
        $deleteDaily->day = $_POST['NewsdailyForm']['day'];
        $deleteDaily->message = $_POST['NewsdailyForm']['message'];

        if ($deleteDaily->deleteDaily()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde gelöscht!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Löschen der Daten!');
        }

        return $this->redirect(['dailys']);
    }

    public function actionEditdaily() {
        $editDaily = new NewsdailyForm();
        $editDaily->id = $_POST['NewsdailyForm']['id'];
        ;
        $editDaily->day = $_POST['NewsdailyForm']['day'];
        $editDaily->message = $_POST['NewsdailyForm']['message'];

        if ($editDaily->editDaily()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde geändert!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Ändern der Daten!');
        }

        return $this->redirect(['dailys']);
    }

    public function actionNews() {
        $query = Newsrss::find()->all();

        return $this->render('news', ['links' => $query]);
    }

    public function actionNewsupdate() {


        $newsRssUpdate = new NewsrssUpdate();
        $newsRssUpdate->id = $_POST['NewsrssUpdate']['id'];
        $newsRssUpdate->URL = $_POST['NewsrssUpdate']['URL'];
        $newsRssUpdate->Description = $_POST['NewsrssUpdate']['Description'];

        if ($newsRssUpdate->update()) {
            Yii::$app->session->setFlash('success', 'Der Änderung wurde gespeichert!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Ändern der Daten!');
        }
        return $this->redirect(['news']);
    }

    public function actionTickermessages() {
        $query = Tickermeldungen::find()->orderBy('Ablaufdatum')->all();

        return $this->render('tickermessages', ['messages' => $query]);
    }

    public function actionAddticker() {
        $addTicker = new TickermeldungenForm();
        $addTicker->ID = 0;
        $addTicker->Ablaufdatum = $_POST['TickermeldungenForm']['Ablaufdatum'];
        $addTicker->text = $_POST['TickermeldungenForm']['text'];

        if ($addTicker->addTicker()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde erstellt!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Speichern der Daten!');
        }

        return $this->redirect(['tickermessages']);
    }

    public function actionDeleteticker() {
        $deleteTicker = new TickermeldungenForm();
        $deleteTicker->ID = $_POST['TickermeldungenForm']['ID'];
        ;
        $deleteTicker->Ablaufdatum = $_POST['TickermeldungenForm']['Ablaufdatum'];
        $deleteTicker->text = $_POST['TickermeldungenForm']['text'];

        if ($deleteTicker->deleteTicker()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde gelöscht!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Löschen der Daten!');
        }

        return $this->redirect(['tickermessages']);
    }

    public function actionEditticker() {
        $editTicker = new TickermeldungenForm();
        $editTicker->ID = $_POST['TickermeldungenForm']['ID'];
        ;
        $editTicker->Ablaufdatum = $_POST['TickermeldungenForm']['Ablaufdatum'];
        $editTicker->text = $_POST['TickermeldungenForm']['text'];

        if ($editTicker->editTicker()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde geändert!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Ändern der Daten!');
        }

        return $this->redirect(['tickermessages']);
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

            $newEntry->Dozent = $_POST['Kursplan']['Dozent'];
            $newEntry->Fach = $_POST['Kursplan']['Fach'];
            $newEntry->Raum = $_POST['Kursplan']['Raum'];
            $newEntry->ZeitVon = $zeitvon;
            $newEntry->ZeitBis = $zeitbis;
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
                if (strtoupper($_POST['Kursplan']['Semester']) . $_POST['Semester'] === $q->Semester) {
                    Yii::$app->session->setFlash('error', 'Kurs ist bereits vorhanden!');
                    return $this->refresh();
                }
            }
            $newEntry->Semester = strtoupper($_POST['Kursplan']['Semester']) . $_POST['Semester'];
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
        $newEntry = new Vvs();

        $query = Vvs::find()->all();

        return $this->render('vvs', ['items' => $query, 'newEntry' => $newEntry]);
    }

    public function actionVvsadd() {
        $model = new Vvs();

        $model->name = $_POST['Vvs']['name'];
        $model->direction = $_POST['Vvs']['direction'];

        $file = UploadedFile::getInstance($model, 'file_path');

        $model->file_path = 'media/vvs/' . $file->name;


        if ($file != NULL) {
            $file->saveAs(Yii::getAlias('@frontend/web/media/vvs/') . $file->name);
        }

        $model->save();
        return $this->redirect(['/site/vvs']);
    }

    public function actionVvsedit() {
        $model = Vvs::findOne($_POST['Vvs']['id']);
        $query = new Vvs();

        $model->name = $_POST['Vvs']['name'];
        $model->direction = $_POST['Vvs']['direction'];

        $file = UploadedFile::getInstance($query, 'file_path');

        $model->file_path = 'media/vvs/' . $file->name;

        if ($file != NULL) {
            $file->saveAs(Yii::getAlias('@frontend/web/media/vvs/') . $file->name);
        }

        $model->update();
        return $this->redirect(['/site/vvs']);
    }

    public function actionVvsdelete() {
        $model = Vvs::findOne($_POST['Vvs']['id']);
        $model->delete();

        return $this->redirect(['/site/vvs']);
    }

    /*
      public function actionEdit($id) {
      if ($id != NULL) {
      $model = Dozent::findOne($id);
      if ($model === null) {
      throw new NotFoundHttpException;
      }
      } else {
      $model = new Dozent();
      }
      //var_dump($model); die();
      $modelUpdate = new DozentUpdateForm();
      $modelPicture = new DozentPictureForm();

      // -----------------------------------------------------

      if ($modelPicture->load(Yii::$app->request->post()) && $modelPicture->validate()) {
      //echo "<script>console.log( 'drin' );</script>";
      //var_dump($modelPicture); die;
      $modelPicture->picture = UploadedFile::getInstance($modelPicture, 'picture');
      if ($modelPicture->upload($model)) {
      return $this->refresh();
      }
      }

      // -----------------------------------------------------


      if (Yii::$app->request->isPost) {

      $model->file_path = UploadedFile::getInstance($model, 'file_path');
      $model->saveAs('upload/' . $_POST['Vvs']['file_path']);
      if ($model->upload()) {
      // file is uploaded successfully
      return $this->redirect(['/site/vvs']);
      }

      return $this->refresh();
      } else {
      return $this->render('edit', ['model' => $model, 'modelUpdate' => $modelUpdate, 'modelPicture' => $modelPicture]);
      }
      }
     */

    public function actionSmsmessage() {
        $query = Authorisiertenummern::find()->orderBy('name')->all();

        $newNumber = new AuthorisiertenummernForm();
        $changedNumber = new AuthorisiertenummernForm();

        return $this->render('smsmessage', ['numbers' => $query, 'newNumber' => $newNumber, 'changedNumber' => $changedNumber]);
    }

    public function actionAddnumber() {
        $newNumber = new AuthorisiertenummernForm();
        $newNumber->name = $_POST['AuthorisiertenummernForm']['name'];
        $newNumber->nummer = $_POST['AuthorisiertenummernForm']['nummer'];
        $newNumber->oldnumber = $_POST['AuthorisiertenummernForm']['nummer'];

        //////// ADD NEW NUMBER /////////
        if ($newNumber->addNumber()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde erstellt!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Erstellen der Daten!');
        }

        return $this->redirect(['smsmessage']);
    }

    public function actionRemovenumber() {
        $removeNumber = new AuthorisiertenummernForm();
        $removeNumber->name = $_POST['AuthorisiertenummernForm']['name'];
        $removeNumber->nummer = $_POST['AuthorisiertenummernForm']['nummer'];
        $removeNumber->oldnumber = $_POST['AuthorisiertenummernForm']['nummer'];

        //////// DELETE NUMBER /////////
        if ($removeNumber->deleteNumber()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde gelöscht!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Löschen der Daten!');
        }

        return $this->redirect(['smsmessage']);
    }

    public function actionEditnumber() {

        $editNumber = new AuthorisiertenummernForm();
        $editNumber->name = $_POST['AuthorisiertenummernForm']['name'];
        $editNumber->nummer = $_POST['AuthorisiertenummernForm']['nummer'];
        $editNumber->oldnumber = $_POST['AuthorisiertenummernForm']['oldnumber'];

        //////// CHANGE NUMBER /////////
        if ($editNumber->update()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde geändert!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Ändern der Daten!');
        }

        return $this->redirect(['smsmessage']);
    }

    public function actionKurs() {
        $query = Fach::find()->orderBy('Name')->all();

        return $this->render('kurs', ['items' => $query]);
    }

    public function actionNewkurs() {

        $newKurs = new KursUpdateForm();
        $newKurs->Name = $_POST['KursUpdateForm']['Name'];

        //////// ADD NEW KURS /////////
        if ($newKurs->add()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde erstellt!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Erstellen der Daten!');
        }

        return $this->redirect(['kurs']);
    }

    public function actionEditkurs() {

        $kurs = new KursUpdateForm();
        $kurs->ID = $_POST['KursUpdateForm']['ID'];
        $kurs->Name = $_POST['KursUpdateForm']['Name'];

        //////// UPDATE KURS /////////
        if ($kurs->update()) {
            Yii::$app->session->setFlash('success', 'Die Änderungen wurden erfolgreich übernommen.');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Speichern der Daten!');
        }

        return $this->redirect(['kurs']);
    }

    public function actionRemovekurs() {
        $kurs = new KursUpdateForm();
        $kurs->ID = $_POST['KursUpdateForm']['ID'];

        //////// DELETE Kurs /////////
        if ($kurs->delete()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde erfolgreich gelöscht.');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Löschen der Daten!');
        }

        return $this->redirect(['kurs']);
    }

    public function actionDozent() {
        $editDozentPictureUpdate = new DozentPictureUpdateForm();
        $editDozentPictureUpdate->dozentPictureForm = new DozentPictureForm();

        if (Yii::$app->request->isPost) {

            $editDozentPictureUpdate->dozentPictureForm->picture = UploadedFile::getInstance($editDozentPictureUpdate->dozentPictureForm, 'picture');
            $editDozentPictureUpdate->id = $_POST['DozentPictureUpdateForm']['id'];

            if ($editDozentPictureUpdate->upload()) {
                Yii::$app->session->setFlash('success', 'Das Bild wurde erfolgreich hochgeladen.');
            } else {
                Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Hochladen des Bildes!');
            }
        }

        $query = Dozent::find()->orderBy('Name')->all();

        return $this->render('dozent', ['dozents' => $query, 'editDozentPictureUpdate' => $editDozentPictureUpdate]);
    }

    public function actionNewdozent() {

        $newDozent = new DozentUpdateForm();
        $newDozent->id = 0;
        $newDozent->name = $_POST['DozentUpdateForm']['name'];
        $newDozent->vorname = $_POST['DozentUpdateForm']['vorname'];
        $newDozent->titel = $_POST['DozentUpdateForm']['titel'];
        $newDozent->position = $_POST['DozentUpdateForm']['position'];
        $newDozent->sprechzeiten = $_POST['DozentUpdateForm']['sprechzeiten'];
        $newDozent->raum = $_POST['DozentUpdateForm']['raum'];
        $newDozent->telefon = $_POST['DozentUpdateForm']['telefon'];
        $newDozent->email = $_POST['DozentUpdateForm']['email'];

        //////// ADD NEW DOZENT /////////
        if ($newDozent->add()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde erstellt!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Erstellen der Daten!');
        }

        return $this->redirect(['dozent']);
    }

    public function actionEditdozent() {

        $dozent = new DozentUpdateForm();
        $dozent->id = $_POST['DozentUpdateForm']['id'];
        $dozent->name = $_POST['DozentUpdateForm']['name'];
        $dozent->vorname = $_POST['DozentUpdateForm']['vorname'];
        $dozent->titel = $_POST['DozentUpdateForm']['titel'];
        $dozent->position = $_POST['DozentUpdateForm']['position'];
        $dozent->sprechzeiten = $_POST['DozentUpdateForm']['sprechzeiten'];
        $dozent->raum = $_POST['DozentUpdateForm']['raum'];
        $dozent->telefon = $_POST['DozentUpdateForm']['telefon'];
        $dozent->email = $_POST['DozentUpdateForm']['email'];

        //////// UPDATE DOZENT /////////
        if ($dozent->update()) {
            Yii::$app->session->setFlash('success', 'Die Änderungen wurden erfolgreich übernommen.');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Speichern der Daten!');
        }

        return $this->redirect(['dozent']);
    }

    public function actionEditdozentpicture() {

        var_dump($_POST);
        die();
    }

    public function actionRemovedozent() {


        $dozent = new DozentUpdateForm();
        $dozent->id = $_POST['DozentUpdateForm']['id'];
        $dozent->name = '';
        $dozent->vorname = '';
        $dozent->titel = '';
        $dozent->position = '';
        $dozent->sprechzeiten = '';
        $dozent->raum = '';
        $dozent->telefon = '';
        $dozent->email = '';

        //////// DELETE DOZENT /////////
        if ($dozent->delete()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde erfolgreich gelöscht.');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Löschen der Daten!');
        }

        return $this->redirect(['dozent']);
    }

}
