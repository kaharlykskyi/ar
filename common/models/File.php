<?php

namespace common\models;

use Yii;
use yii\base\Security;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property integer $object_id
 * @property integer $object_type
 * @property string $name
 * @property string $path
 * @property integer $sort
 * @property integer $file_type
 * @property integer $created_at
 * @property integer $updated_at
 */
class File extends \yii\db\ActiveRecord
{
    const OBJECT_TYPE_FONT = 1;

    const OBJECT_TYPE_PRODUCT_ELEMENT_CARD_IMAGE = 2;
    const OBJECT_TYPE_PRODUCT_ELEMENT_PHOTO = 3;
    const OBJECT_TYPE_PRODUCT_ELEMENT_CARD_BG = 4;

    const OBJECT_TYPE_PRODUCT_ELEMENT_COVER_BG = 6;
    const OBJECT_TYPE_PRODUCT_ELEMENT_COVER_FON = 7;

    const OBJECT_TYPE_PRODUCT = 8;
    const OBJECT_TYPE_RECEIVER = 9;
    const OBJECT_TYPE_PRODUCT_RESOURCE = 10;
    const OBJECT_TYPE_ENVELOPE_PHOTO = 11;


    const FILE_TYPE_PICTURE = 1; // for Picture
    const FILE_TYPE_VIDEO = 2; // for Picture
    const FILE_TYPE_DOCUMENT = 3; // for Picture
    const FILE_TYPE_FONT = 4; // for Font
    const FILE_TYPE_CSV = 5; // for Font
    const FILE_TYPE_OTHERS = 6; // for Font


    public $objectsList;

    public $full_path;

    public $_pathList = [];

    public $user_task_message_id;

    function init(){

        $this->_pathList = [
            1=>\Yii::$app->params['fontPath'],
            2=>\Yii::$app->params['productElementCardImage'],
            3=>\Yii::$app->params['productElementPhoto'],
            4=>\Yii::$app->params['productElementCardBg'],
            6=>\Yii::$app->params['productElementCoverBg'],
            7=>\Yii::$app->params['productElementCoverFon'],
            8=>\Yii::$app->params['productPath'],
            9=>\Yii::$app->params['productReceiver'],
            10=>\Yii::$app->params['productResource'],
            11=>\Yii::$app->params['productEnvelopePhoto'],
        ];

    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    public function behaviors()
    {

        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ]
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id', 'object_type', 'sort', 'file_type', 'created_at', 'updated_at'], 'integer'],
            [['name', 'path'], 'string', 'max' => 1024],
            [['objectsList'], 'file', 'skipOnEmpty' => true, /*'extensions' => 'png, jpg, jpeg, bmp, gif',*/ 'maxFiles' => 15, 'except' => 'uploadImage'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'object_type' => Yii::t('app', '1: article, 2:bank,'),
            'name' => Yii::t('app', 'Name'),
            'path' => Yii::t('app', 'Path'),
            'sort' => Yii::t('app', 'Sort'),
            'file_type' => Yii::t('app', 'File Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    public function upload($id, $object_type, $path='', $file_type='', &$returnModel="")
    {
        $newIds = \Yii::$app->request->post('new_img', '');

        $newIdsArray = [];
        if($newIds != '')
            $newIdsArray = explode(",", $newIds);

        if($path == "")
            $path =  $this->_pathList[$object_type];

        if($file_type == "")
            $file_type =  File::FILE_TYPE_PICTURE;



        $security = new Security();
        $image_path = Yii::getAlias('@repository') . $path . $id;

        if (!file_exists($image_path))
            mkdir($image_path, 0777, true);

        $ind = 0;


        foreach ($this->objectsList as $file) {

            $image = $security->generateRandomString(64).'_'.time(). ".{$file->getExtension()}";
            $full_path = $image_path . '/' . $image;

            if ($file->saveAs($full_path)) {

                $model = new $this();
                $model->setScenario('uploadImage');
                $model->name = $file->name;
                $model->path = $image;
                $model->object_id = $id;
                $model->object_type = $object_type;
                $model->file_type = $file_type;
                $model->sort = (count($newIdsArray)<=1 ? 1:$newIdsArray[$ind]);


                $ind++;

                if ($model->save()){
                    $returnModel[]=$model;
                    continue;
                } else {
                    // exit;
                    unlink($full_path);
                    throw new ErrorException();
                }
            } else {
                return false;
            }
        }
        return true;
    }

    public function releation($id, $object_type, $path)
    {
        $model_id="";
        $newIds = \Yii::$app->request->post('img_ids', '');

        $newIdsArray = [];
        if($newIds != '')
            $newIdsArray = explode(",", rtrim($newIds, ","));

        $security = new Security();
        $image_path = Yii::getAlias('@repository') . $path . $id;

        if (!file_exists($image_path))
            mkdir($image_path, 0777, true);

        $ind = 0;

        $cImg = new \common\components\CImage();

        foreach ($newIdsArray as $row) {
            $ind++;
            $rowArray = explode(':', $row);

            $picModel = File::findOne($rowArray[0]);
            if (isset($picModel->id)) {

                if($picModel->object_id == ""){
                    $source = Yii::getAlias('@repository') . Yii::$app->params['pictureUnsavedPath'] . $picModel->path;
                    $dest_path = $image_path . '/' . $picModel->path;

                    if(is_file($source))
                    {
                        rename($source, $dest_path);
                        $picModel->object_id = $id;
                        $picModel->object_type = $object_type;
                    }
                    $img_path = $dest_path;
                }
                else{
                    $img_path = Yii::getAlias('@repository') . $this->_pathList[$picModel->object_type].$picModel->object_id."/".$picModel->path;
                }

                if(isset($rowArray[2]) && $rowArray[2]!=0)
                {
                    $model_id=$picModel->id;
                    $cImg->rotate($img_path, $rowArray[2]);
                    $picModel->updated_at = time();
                }

                $picModel->sort = $ind;
                $picModel->save();
            }
        }

        if($model_id!=""){
            $this->removeCache("cache".$this->_pathList[$object_type].$id);
        }

        return true;
    }


    function rotate($img_ids){

        $newIdsArray = explode(",", rtrim($img_ids, ","));

        $ind = 0;
        $cImg = new \common\components\CImage();
        foreach ($newIdsArray as $row) {
            $ind++;
            $rowArray = explode(':', $row);

            $picModel = File::findOne($rowArray[0]);
            if (isset($picModel->id)) {

                if($picModel->object_id == ""){
                    $img_path = Yii::getAlias('@repository') . Yii::$app->params['pictureUnsavedPath'] . $picModel->path;

                    if(isset($rowArray[2]) && $rowArray[2]!=0)
                    {
                        $cImg->rotate($img_path, $rowArray[2]);
                        $picModel->updated_at = time();
                        $picModel->save();
                        $p = explode(".", $picModel->path);
                        $this->removeCacheFile("cache".Yii::$app->params['pictureUnsavedPath'].$p[0]."*");
                    }
                }
            }
        }
    }

    /**
     *
     * @param $realty_id
     * @return bool
     * @throws ErrorException
     */
    public function uploadFromBlob($filename, $data, $file_type = '')
    {
        $security = new Security();
        $path = Yii::$app->params['pictureUnsavedPath'];
        $image_path = Yii::getAlias('@repository') . $path;

        if (!file_exists($image_path))
            mkdir($image_path, 0777, true);


        $path_info = pathinfo($filename);

        $image = $security->generateRandomString(64).'_'.time(). ".{$path_info['extension']}";
        $full_path = $image_path . '/' . $image;

        $decodedData = base64_decode($data);
        $fp = fopen($full_path, 'wb');
        fwrite($fp, $decodedData);
        fclose($fp);

        $model = new $this();
        $model->setScenario('uploadImage');
        $model->path = $image;
        $model->sort = 1;
        if ($model->save()){
            return $model;
        } else {
            // exit;
            unlink($full_path);
            throw new ErrorException();
        }
        return [];

    }

    public function addImage($object_id){

        $model = $this::find()
            ->where('object_id=:object_id', [
                ':object_id'=>$object_id
            ])->one();

        if(!isset($model->id))
        {
            $model = new $this;
            $model->path = "";
            $model->object_id = $object_id;
            $model->save();
        }

        return $model;
    }

    public function getImageUrl($path)
    {
        if(file_exists($this->getImagePath($path)))
            $image = Yii::getAlias('@repository_www') . $path . $this->object_id. "/". $this->path;
        else
            $image = Yii::$app->params['nopic'];

        return $image;
    }

    public function getImagePath($path)
    {
        $path = Yii::getAlias('@repository') . $path . $this->object_id. "/". $this->path;
        return $path;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'object_id']);
    }

    public function updatePictureSort()
    {
        $oldIds = \Yii::$app->request->post('old_img');

        $oldIdsArray = explode(",", $oldIds);

        $cImg = new \common\components\CImage();

        $model = "";
        foreach ($oldIdsArray as $item) {

            $row = explode(":", $item);

            if(isset($row[1]))
            {
                $model = File::findOne($row[0]);

                // rotate $row[2]
                if(isset($model->id)){
                    $model->sort = $row[1];
                    $model->save();
                }

                if(isset($row[2]) && $row[2]!=0)
                {
                    $img = $this->_pathList[$model->object_type].$model->object_id."/".$model->path;
                    $cImg->rotate($img, $row[2]);
                }
            }
        }
        if(isset($model->id)){
            $this->removeCache("cache".$this->_pathList[$model->object_type].$model->object_id);
        }
    }

    function removeCache($path)
    {
        array_map('unlink', glob($path."/*.*"));
        if(file_exists($path."/"))
            rmdir($path);
    }

    function removeCacheFile($path)
    {
        array_map('unlink', glob($path."*.*"));
    }

    function deleteFileOLD($folder, $object_id, $object_type, $pic_type="")
    {
        $par = [
            'object_id'=>$object_id,
            'object_type'=>$object_type,
        ];

        if($pic_type != "")
            $par['pic_type'] = $pic_type;

        $model = File::find()->where($par)->all();

        // var_dump(\Yii::getAlias('@repository').$folder.$item->path);
        // exit;

        foreach ($model as $item){
            if(file_exists(\Yii::getAlias('@repository').$folder.$item->path))
                unlink(Yii::getAlias('@repository').$folder.$item->path);
        }

        File::deleteAll($par);
    }

    public static function deleteFile($folder, $object_id, $object_type, $pic_type="")
    {
        $par = [
            'object_id'=>$object_id,
            'object_type'=>$object_type,
        ];

        if($pic_type != "")
            $par['pic_type'] = $pic_type;

        $model = File::find()->where($par)->all();

        // var_dump(\Yii::getAlias('@repository').$folder.$item->path);
        // exit;

        foreach ($model as $item){

            echo \Yii::getAlias('@repository').$folder.$object_id."/".$item->path." ";

            if(file_exists(\Yii::getAlias('@repository').$folder.$object_id."/".$item->path))
                unlink(\Yii::getAlias('@repository').$folder.$object_id."/".$item->path);
        }

        File::deleteAll($par);
    }


    function getFullPath()
    {
        return Yii::getAlias('@repository_www').$this->_pathList[$this->object_type] .$this->object_id."/".$this->path;
    }

    function getShortPath()
    {
        return $this->_pathList[$this->object_type] .$this->object_id."/".$this->path;
    }

    function getShortPathNoId()
    {
        return $this->_pathList[$this->object_type] .$this->path;
    }



}
