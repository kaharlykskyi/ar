<?php

namespace frontend\modules\eventOrder\controllers;

use common\models\order\Order;
use common\models\order\OrderProduct;
use yii\base\Event;
use yii\web\Controller;
use Yii;
use yii\filters\VerbFilter;

/**
 * InfoCalendarController implements the CRUD actions for InfoCalendar model.
 */
class BasketController extends Controller
{
    // public $layout = 'pages';

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
     * Lists all InfoCalendar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Order();

        $data =  $this->actionGet();

        return $this->render('index', [
            'data' => $data,
            'model' => $model
        ]);
    }

    /**
     * Lists all InfoCalendar models.
     * @return mixed
     */
    public function actionDropbox()
    {
        // $module = InfoCalendar::find()->all();
        // $session = Yii::$app->session;
        // $session->destroy();

        $data =  $this->actionGet();

        return $this->renderPartial('//basket/dropbox', [
            'data' => $data
        ]);
    }

    public function actionAdd()
    {
        $object_id = \Yii::$app->request->post('object_id', '');
        $object_type = \Yii::$app->request->post('object_type', '');
        
        $price = \Yii::$app->request->post('price', '');
        $count = \Yii::$app->request->post('count', '1');

        // open a session
        if(!isset(\Yii::$app->session['product']))
        {
            \Yii::$app->session['product'] = [];
            $product = [];
        }
        else{
            $product = [];
            foreach(\Yii::$app->session['product'] as $key => $item)
            {
                $product[$key] = $item;
            }
        }

        $hash = md5($object_id);

        if(isset($product[$hash]))
        {
            $product[$hash]['count']+=$count;
        }
        else{
            /*
            $colorModel =  Attribute::find()->where('type_id=1')->all();
            $colorArray = ArrayHelper::map($colorModel, 'id','title');

            $sizeModel =  Attribute::find()->where('type_id=2')->all();
            $sizeArray = ArrayHelper::map($sizeModel, 'id','title');
            */

            $product[$hash] = [
                'object_id'=>$object_id,
                'object_type'=>$object_type,
                'price'=>$price,
                'count'=>$count,
                'hash'=>md5($object_id)
            ];
        }

        \Yii::$app->session['product'] = $product;

        echo json_encode($this->buildList());
        Yii::$app->end();
    }

    public function actionAddPublic()
    {

        $object_id = Yii::$app->request->get('prod_ean', '');
        $object_id = explode("-",$object_id);
        $object_id = $object_id[1];

        $price = Yii::$app->request->get('price', '');
        $count = Yii::$app->request->get('count', '1');

        $address = Yii::$app->request->get('address', '');
        $fio = Yii::$app->request->get('fio', '');


        $model = Product::findOne($object_id);

        $color_id = $model->attr->color_id;
        $size_id = $model->attr->size_id;

        // open a session
        if(!isset(\Yii::$app->session['product']))
        {
            \Yii::$app->session['product'] = [];
            $product = [];
        }
        else{
            // echo "aaaaa2222";
            // \Yii::$app->session['product']
            $product = [];
            foreach(\Yii::$app->session['product'] as $key => $item)
            {
                $product[$key] = $item;
            }
        }

        $hash = md5($object_id.$color_id.$size_id);

        if(isset($product[$hash]))
        {
            $product[$hash]['count']+=$count;
        }
        else{

            /*
            $colorModel =  Attribute::find()->where('type_id=1')->all();
            $colorArray = ArrayHelper::map($colorModel, 'id','title');

            $sizeModel =  Attribute::find()->where('type_id=2')->all();
            $sizeArray = ArrayHelper::map($sizeModel, 'id','title');
            */
            $product[$hash] = [
                'object_id'=>$object_id,
                'price'=>$price,
                'count'=>$count,
                'hash'=>md5($object_id)
            ];
        }

        \Yii::$app->session['product'] = $product;
        $this->redirect('/index.php?r=order/create&address='.$address.'&fio='.$fio);
    }


    public function actionSet()
    {

        $hash = Yii::$app->request->post('hash', '');
        $count = Yii::$app->request->post('count', '1');

        // open a session
        if(!isset(\Yii::$app->session['product']))
        {
            \Yii::$app->session['product'] = [];
            $product = [];
        }
        else{
            // echo "aaaaa2222";
            // \Yii::$app->session['product']
            $product = [];
            foreach(\Yii::$app->session['product'] as $key => $item)
            {
                $product[$key] = $item;

                if($key == $hash)
                    $product[$key]['count'] = $count;
            }
        }

        \Yii::$app->session['product'] = $product;

        $res = $this->buildList();
        $res['hash'] = $hash;

        return json_encode($res);

        Yii::$app->end();
    }



    public function  buildList()
    {
        $data =  $this->actionGet();
        $basketData = [
            'count'=>$data['count'],
            'sum'=>$data['sum'],
            'delivery_sum'=>$data['delivery_sum'],
            'html'=>$this->renderPartial('_list', [
                'data' => $data
            ])
        ];

        return [
            'status'=>'success',
            'basketData'=>$basketData,
        ];

    }

    public function actionGet()
    {
        /*
        $basket = new BasketController('', '');
        $basket->actionEmpty();
        exit;
        */
        $count = 0;
        $sum = 0;
        $delivery_sum = 0;
        $data = [];
        if(isset(\Yii::$app->session['product']))
        {
            /*
            var_dump(\Yii::$app->session['product']);
            exit;
            */
            
            foreach (\Yii::$app->session['product'] as $hash => $value){

                if(isset($value['object_id']) && $value['object_id']!="")
                {
                    if($value['object_type'] == OrderProduct::OBJECT_TYPE_EVENT)
                    {
                        $product = \common\models\event\Event::findOne($value['object_id']);
                        $cImg = new \common\components\CImage();

                        $img = "";
                        if(isset($product->productObjectUser->product))
                            $img = $cImg->getFile($product->productObjectUser->product->firstPictureShortPath, 100, 140, 'center');

                        $name = $product->host_name;
                        $price = 10;
                    }

                    if(isset($product->id))
                    {
                        $data[$hash] = $value;
                        $data[$hash]['name'] = $name;
                        $data[$hash]['img'] = $img;
                        $data[$hash]['price'] = $price;
                        $data[$hash]['delivery_price'] = 0; /*isset($deliveryPrice->price) ? $deliveryPrice->price*$data[$hash]['count']:"";*/
                        $count+=$data[$hash]['count'];

                        $sum += $price * $data[$hash]['count'];
                        $delivery_sum += $data[$hash]['delivery_price'];
                    }
                }
            }
        }
        return [
            'products'=>$data,
            'count'=>$count,
            'sum'=>$sum,
            'delivery_sum'=>$delivery_sum,
        ];
    }


    public function actionEmpty()
    {
        \Yii::$app->session['product'] = [];
    }


    public function actionRemove()
    {
        $hash = Yii::$app->request->post('hash', '');

        $product = [];
        foreach(\Yii::$app->session['product'] as $key=>$item)
        {
            if($key != $hash)
                $product[$key] = $item;
        }

        \Yii::$app->session['product'] = $product;


        $res = $this->buildList();
        $res['hash'] = $hash;

        return json_encode($res);

        Yii::$app->end();

    }



}
