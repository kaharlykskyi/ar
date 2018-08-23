<?php
namespace common\components;

use common\models\MailText;
use common\models\product\Category;
use common\models\product\OfferValidate;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\StringHelper;

class CCSV extends Component {

    public $_category = [];
    public $_mailText = [];

    public function __construct()
    {
        
    }

    public function import($model)
    {
        $file = Yii::getAlias('@frontend') . '/web' . $model->csv->fullPath;

        if (!file_exists($file)) {
            return array(
                'status' => 'error',
                'msg' => \Yii::t('Файл не существует', '')
            );
        }

        $rows = [];

        if (($handle = fopen($file, "r")) !== FALSE) {
            $rowIndex = 0;
            $error = [];

            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {

                $data[0] = trim($data[0]);
                $data[1] = trim($data[1]);

                if ($data[0]!= "" && $data[1]!= "" && filter_var($data[1], FILTER_VALIDATE_EMAIL)) {
                    $rows[] = [
                        'event_id' => $model->id,
                        'name' => $data[0],
                        'email' => $data[1],
                        'created_at' => time()
                    ];
                }
            }
            if (count($rows)>0) {
                $tableName = 'receiver_event';
                $columnNameArray=['event_id', 'name', 'email', 'created_at'];
                \Yii::$app->db->createCommand()->batchInsert($tableName, $columnNameArray, $rows)->execute();
            }
        }
    }



    public function validateOffer($offer)
    {

        $model = new OfferValidate();


        $model->category_id = (string)$offer->categoryId;
        $model->price=(string)$offer->price;
        $model->name=(string)$offer->name;
        $model->brand=(string)$offer->vendor;
        $model->url=(string)$offer->url;

        return [
            'status'=>$model->validate(),
            'msg'=>$model->getErrors()
        ];
    }




}