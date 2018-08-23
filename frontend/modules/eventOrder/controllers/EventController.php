<?php

namespace frontend\modules\eventOrder\controllers;

use common\components\CCSV;
use common\components\CMail;
use common\models\event\Event;
use common\models\event\ReceiverEvent;
use common\models\event\search\ReceiverEventSearch;
use common\models\File;
use common\models\ProductObject\ElementType;
use common\models\ProductObject\PageType;
use common\models\ProductObject\Photo;
use common\models\ProductObject\ProductObject;
use common\models\ProductObject\ProductObjectElement;
use common\models\ProductObject\ProductObjectPage;
use common\models\ProductObject\ProductObjectUser;
use Yii;
use common\models\Shop;
use common\models\search\ShopSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ShopController implements the CRUD actions for Shop model.
 */
class EventController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];
        /*
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
        */
    }

    /**
     * Updates an existing Shop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionIndex()
    {
        return $this->actionCreate();

        // $photoModel = new Photo();
        /*return $this->render('index', [
            'model'=>''
        ]);
        */
    }


    public function actionCreate()
    {
        $model = new Event(['scenario' => 'create']);

        $searchModelReceiver = new ReceiverEventSearch();
        $dataProviderReceiver = $searchModelReceiver->search([], [
            'event_id'=>'-1'
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {

            $model->user_id = \Yii::$app->user->id;
            if($model->save()){


                $file = new File();
                $file->objectsList = UploadedFile::getInstances($model, 'attachments');

                if(!empty($file->objectsList))
                {
                    $file->upload(
                        $model->id,
                        File::OBJECT_TYPE_RECEIVER,
                        '',
                        File::FILE_TYPE_CSV
                    );

                    $xml = new CCSV();
                    $xml->import($model);
                }

                return $this->redirect(['update', 'id'=>$model->id]);
            }
        }


        return $this->render('index', [
            'model' => $model,
            'dataProviderReceiver' => $dataProviderReceiver,
            'modelReceiver' => ""
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'create';
        $modelReceiver = new ReceiverEvent();

        $searchModelReceiver = new ReceiverEventSearch();
        $dataProviderReceiver = $searchModelReceiver->search([], [
            'event_id'=>$model->id
        ]);
        $dataProviderReceiver->sort->sortParam = false;


        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {

            $file = new File();
            $file->objectsList = UploadedFile::getInstances($model, 'attachments');

            if(!empty($file->objectsList))
            {
                File::deleteAll('object_id =:object_id and object_type=:object_type', [
                    ':object_id' => $model->id,
                    ':object_type' => File::OBJECT_TYPE_RECEIVER
                ]);

                $file->upload(
                    $model->id,
                    File::OBJECT_TYPE_RECEIVER,
                    '',
                    File::FILE_TYPE_CSV
                );

                $xml = new CCSV();
                $xml->import($model);
            }
            return $this->redirect(['update', 'id'=>$model->id]);
        }
        else{
            $model->date_to_send_text = date('d.m.Y', $model->date_to_send);
        }

        return $this->render('index', [
            'model' => $model,
            'dataProviderReceiver' => $dataProviderReceiver,
            'modelReceiver' => $modelReceiver,
        ]);
    }

    public function actionResend(){

        $id = \Yii::$app->request->get('id');

        $model = ReceiverEvent::findOne($id);

        $user = \Yii::$app->user->identity;
        $mail = new CMail();
        $mail->send([
            'alias'=>'event',
            'model'=>[
                'event'=>$model->event,
                'id'=>$model->id,
                'event_id'=>'',
                'name'=>$model->name,
            ],
            'to'=>$model->email,
            'name'=>$model->name,
            'subject'=>$model->event->event_name
        ]);

        return $this->redirect(['update', 'id'=>$model->event->id]);
    }
    
    public function actionTestSend(){

        $id = \Yii::$app->request->get('id');

        $model = Event::findOne($id);

        $user = \Yii::$app->user->identity;
        $mail = new CMail();
        $mail->send([
            'alias'=>'event',
            'model'=>[
                'event'=>$model,
                'id'=>'',
                'event_id'=>$model->id,
                'name'=>$user->fullname,
            ],
            'to'=>$user->email, /* $item->email, */
            'name'=>$user->fullname,
            'subject'=>$model->event_name
        ]);

        return $this->redirect(['update', 'id'=>$model->id]);
    }


    public function actionCloneGuest(){

        $id = \Yii::$app->request->get('id');
        $from = \Yii::$app->request->get('from');

        $sql = 'INSERT INTO receiver_event(event_id, `name`, `email`, `invited`)
                SELECT  :to_id id,  evf.name, evf.email, evf.invited
                FROM receiver_event evf
                LEFT JOIN receiver_event ev
                  ON evf.email = ev.email AND ev.event_id = :to_id
                WHERE ev.email IS NULL  AND evf.event_id = :from_id';

        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':from_id', $from);
        $command->bindValue(':to_id', $id);
        $command->execute();

        return $this->redirect(['update', 'id'=>$id]);
    }


    public function actionDelete($id)
    {
        ReceiverEvent::deleteAll('event_id=:event_id', [
            'event_id'=>$id
        ]);

        $this->findModel($id)->delete();

        return $this->redirect(['/event-order/event/index']);

    }


    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}