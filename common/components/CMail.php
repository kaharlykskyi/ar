<?php
namespace common\components;

use common\models\MailText;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\StringHelper;

class CMail extends Component {

    public $_mailText = [];

    public function __construct()
    {

        
    }

    public function send($data){

        $langOld = \Yii::$app->language;

        if(isset($data['lang'])){
            \Yii::$app->language = $data['lang'];
        }

        if(!isset($data['name'])){
            $data['name'] = "";
        }


        // send admin
        \Yii::$app->mailer->compose($data['alias'], [
            'model'=>$data['model']
        ])
            ->setFrom([\Yii::$app->params['robotEmail'] => ($data['name']!="" ? $data['name']:"")])
            ->setTo($data['to'])
            ->setSubject($data['subject'])
            ->send();

        \Yii::$app->language = $langOld;

        return true;
    }

}