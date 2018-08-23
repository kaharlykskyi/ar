<?php

namespace frontend\modules\eventOrder\controllers;

use Yii;
use common\models\event\ReceiverEvent;
use common\models\event\search\ReceiverEventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReceiverEventController implements the CRUD actions for ReceiverEvent model.
 */
class ReceiverEventController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ReceiverEvent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReceiverEventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReceiverEvent model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ReceiverEvent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReceiverEvent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/event-order/event/update', 'id' => $model->event_id]);
        }

        echo json_encode([
            'status'=>'error',
            'msg'=>$model->getErrors(),

        ]);

        \Yii::$app->end();
    }

    /**
     * Updates an existing ReceiverEvent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['/event-order/event/update', 'id' => $model->event_id]);
        }

        return $this->renderPartial('update', [
            'model' => $model,
        ]);

    }
    
    
    

    /**
     * Deletes an existing ReceiverEvent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $event_id = $this->findModel($id)->event_id;

        $this->findModel($id)->delete();

        return $this->redirect(['/event-order/event/update', 'id' => $event_id]);

    }

    /**
     * Finds the ReceiverEvent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReceiverEvent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReceiverEvent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
