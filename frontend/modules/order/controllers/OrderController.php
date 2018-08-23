<?php

namespace frontend\modules\order\controllers;

use common\components\CMail;
use common\models\event\Event;
use common\models\order\OrderProduct;
use common\models\Product;
use frontend\modules\eventOrder\controllers\BasketController;
use Yii;
use common\models\order\Order;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDetails()
    {
        $id = \Yii::$app->request->get('id');

        $dataProvider = new ActiveDataProvider([
            'query' => OrderProduct::find()->where('order_id=:order_id', [
                ':order_id'=>$id
            ]),
        ]);

        return $this->render('order_details', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        $basket = new BasketController('', '');
        $data =  $basket->actionGet();

        $address = Yii::$app->request->get('address', '');
        $fio = Yii::$app->request->get('fio', '');

        
        return $this->render('create', [
            'model' => $model,
            'data' => $data,
            'address'=>$address,
            'fio'=>$fio
        ]);
    }

    public function actionDone()
    {
        $model = new Order();

        $basket = new BasketController('', '');
        $data =  $basket->actionGet();

        // $address = Yii::$app->request->get('address', '');
        // $fio = Yii::$app->request->get('fio', '');

        $model->sum = $data['sum'];
        $model->total = $data['sum'];
        $model->user_id = \Yii::$app->user->id;

        /*  TODO */
        $model->payed_at = time();

        if($model->validate() && $model->save())
        {
            foreach($data['products'] as $item)
            {
                var_dump($item);

                if(isset($item['object_id']) && $item['object_id']!="" )
                {

                    // 'product_object_id', 'product_id'
                    $eventModel = Event::findOne($item['object_id']);


                    $order_product = new OrderProduct();
                    $order_product->attributes = [
                        'order_id'=>$model->id,
                        'object_id'=>$item['object_id'],
                        'product_object_id'=>$eventModel->productObjectUser->id,
                        'product_id'=>$eventModel->productObjectUser->product_id,
                        'object_type'=>$item['object_type'],
                        'name'=>$item['name'],
                        'price'=>$item['price'],
                        /*'notes'=>$product->notes,*/
                        'count'=>$item['count'],
                        'total'=>$item['price'] * $item['count'] + $item['delivery_price'] * $item['count']
                    ];

                    $order_product->save();

                    $eventModel = Event::findOne($item['object_id']);
                    $eventModel->payed_at = time();
                    $eventModel->save();

                    //var_dump($order_product->getErrors());
                }
            }

            /*
            $mail = new CMail();
            $mail->send([
                'alias'=>'new_order',
                'model'=>$model,
                'to'=>\Yii::$app->params['adminEmail'],
                'subject'=>\Yii::t('app', 'Новый заказ'),
            ]);
            */

            // exit;
            $basket->actionEmpty();
            Yii::$app->session->setFlash('success', 'Thank you for your order');
            return $this->redirect(['/event-order/event/index']);
        }
        return $this->redirect(['/order/order/create']);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionOrderTransfer()
    {
        $id = \Yii::$app->request->get('id');
        $model = Order::findOne($id);

        $this->layout = 'pdf';

        return $this->render('order-transfer', [
            'model'=>$model
        ]);
    }

    public function actionOrderCache()
    {
        $id = \Yii::$app->request->get('id');
        $model = Order::findOne($id);
        
        return $this->render('order-cache', [
            'model'=>$model
        ]);
    }

    public function actionOrderCard()
    {
        $id = \Yii::$app->request->get('id');
        $model = Order::findOne($id);

        return $this->render('order-card', [
            'model'=>$model
        ]);
    }



    public function actionResult()
    {

        $id = \Yii::$app->request->get('id');

        $model = Order::findOne($id);

        if(isset($model->id))
        {
            if($model->payed_at == "")
            {
                return $this->render('order-cancel', [
                ]);
            }
            else{

                $mail = new CMail();
                $mail->send([
                    'alias'=>'new_order',
                    'model'=>$model,
                    'to'=>$model->email,
                    'subject'=>\Yii::t('app', 'Спасибо за ваш заказ'),
                ]);

                $mail = new CMail();
                $mail->send([
                    'alias'=>'new_order_manager',
                    'model'=>$model,
                    'to'=>\Yii::$app->params['adminEmail'],
                    'subject'=>\Yii::t('app', 'Поступил новый заказ'),
                ]);

                $basket = new \frontend\controllers\BasketController('', '');
                $basket->actionEmpty();

                return $this->render('order-success', [
                    'model'=>$model
                ]);
            }
        }

        return $this->redirect("/");

        /*
        $basket = new \frontend\controllers\BasketController('', '');
        $data =  $basket->actionGet();
        */


    }


    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPdf()
    {
        $id = \Yii::$app->request->get('id');

        $model = OrderProduct::findOne($id);

        $svg = $model->svg;


        // echo $svg;
        // exit;


        $width = 148;  // \Yii::$app->params['canvas-width'];
        $height = 210; // \Yii::$app->params['canvas-height'];

        $svg = str_replace(["\t", "\n", "\r"], ["","",""], $svg);
        // $svg = str_replace(["</tspan>/r", "</tspan>/n", "</tspan> "], ["</tspan>", "</tspan>", "</tspan>"], $svg);

        return $this->render('pdf', [
            'svg'=>$svg,
            'pageObject'=>[
                'width'=>$width,
                'height'=>$height
            ]
        ]);
    }
}
