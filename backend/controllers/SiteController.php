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
                        'actions' => ['logout', 'index', 'dozent', 'news', 'newsupdate', 'timetable', 'usergroups', 'vvs',
                            'tickermessages', 'addticker', 'editticker', 'deleteticker',
                            'dailys', 'adddaily', 'deletedaily', 'editdaily',
                            'smsmessage', 'addnumber', 'removenumber', 'editnumber',
                            'newdozent', 'editdozent', 'editdozentpicture', 'removedozent'],
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
        $deleteDaily->id = $_POST['NewsdailyForm']['id'];;
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
        $editDaily->id = $_POST['NewsdailyForm']['id'];;
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
        $deleteTicker->ID = $_POST['TickermeldungenForm']['ID'];;
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
        $editTicker->ID = $_POST['TickermeldungenForm']['ID'];;
        $editTicker->Ablaufdatum = $_POST['TickermeldungenForm']['Ablaufdatum'];
        $editTicker->text = $_POST['TickermeldungenForm']['text'];
        
        if ($editTicker->editTicker()) {
            Yii::$app->session->setFlash('success', 'Der Eintrag wurde geändert!');
        } else {
            Yii::$app->session->setFlash('error', 'Es gab einen Fehler beim Ändern der Daten!');
        }
        
        return $this->redirect(['tickermessages']);
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

    public function actionDozent() {
        $editDozentPictureUpdate = new DozentPictureUpdateForm();
        $editDozentPictureUpdate->dozentPictureForm = new DozentPictureForm();
        
        if(Yii::$app->request->isPost) {
            
            $editDozentPictureUpdate->dozentPictureForm->picture = UploadedFile::getInstance($editDozentPictureUpdate->dozentPictureForm, 'picture');
            $editDozentPictureUpdate->id = $_POST['DozentPictureUpdateForm']['id'];

            if($editDozentPictureUpdate->upload()) {
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
