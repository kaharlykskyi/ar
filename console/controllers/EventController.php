<?php

namespace console\controllers;

use common\components\CCurs;
use common\components\CMail;
use common\models\Calendar;
use common\models\CsvSource;
use common\models\Currency;
use common\models\event\ReceiverEvent;
use common\models\GalleryAdsOrder;
use common\models\Job;
use common\models\Notification;
use common\models\Order;
use common\models\Product;
use common\models\ProductDiscountShop;
use common\models\ProductPriceAlarm;
use common\models\Shop;
use common\models\Task;
use common\models\User;
use common\models\UserMining;
use frontend\components\ImportCsv;
use frontend\controllers\CController;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class EventController extends Controller
{

    public function __construct($id, $module)
    {
        $this->enableCsrfValidation = false;
        parent::__construct($id, $module);
    }

    public function actionSend(){

        $model = ReceiverEvent::find()
            ->innerJoin('event e', 'e.id=receiver_event.event_id')
            ->where('e.payed_at is not null and sended_at is null')
            ->limit('1')
            ->all();

        foreach ($model as $item){

            $item->sended_at = time();

            $mail = new CMail();
            $mail->send([
                'alias'=>'event',
                'model'=>[
                    'event'=>$item->event,
                    'id'=>$item->id,
                    'name'=>$item->name,
                ],
                'to'=>$item->email,
                'subject'=>$item->event->event_name
            ]);
            echo "send ".$item->email."\n";
            $item->save(false);
        }

        echo "end";
        \Yii::$app->end();
    }


    




}