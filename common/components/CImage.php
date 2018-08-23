<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\StringHelper;

class CImage extends Component {

    const CACHE_DIR_IMAGE = "cache";
    // const DEF_IMAGE = '/img/default.png';
    /*
     * $scaleType {center, width, height, wh}
     *
     *
     * */
    public function getFile($filename, $width, $height, $scaleType = '', $defFilename = '') {

        $dirRepository = \Yii::getAlias("@repository")."/";
        $dirFrontend = \Yii::getAlias("@prjpath");

        $old_image = $dirRepository . $filename;


        if (!is_file($dirRepository.$filename)) {
            $filename = Yii::$app->params['nopic'];
            $old_image = $dirFrontend . $filename;
        }

        $extension = pathinfo($dirRepository.$filename, PATHINFO_EXTENSION);


        $fNameNew = mb_substr($filename, 0, mb_strrpos($filename, '.'));

        if($defFilename != "")
        {
            $fName = explode("/", mb_substr($filename, 0, mb_strrpos($filename, '.')));

            $fName[count($fName)-1] = $defFilename;

            $fNameNew = implode("/", $fName);
        }

                
        $new_image = "/" . self::CACHE_DIR_IMAGE . $fNameNew . '-' . $width . 'x' . $height . '.' . $extension;

        if (!is_file($dirFrontend.$new_image) || (filectime($old_image) > filectime($dirFrontend . $new_image))) {
            $path = '';

            $directories = explode('/', dirname(str_replace('../', '', $new_image)));

            foreach ($directories as $directory) {
                $path = $path . '/' . $directory;

                if (!is_dir($dirFrontend . $path)) {
                    @mkdir($dirFrontend . $path, 0777);
                }
            }

            list($width_orig, $height_orig) = getimagesize($old_image);

            if (($width_orig != $width || $height_orig != $height) && $width!=0 && $height != 0) {
                $image = new Image($old_image);
                $image->resize($width, $height, $scaleType);
                $image->save($dirFrontend . $new_image);
            } else {
                copy($old_image, $dirFrontend.$new_image);
            }
        }

        return $new_image;
    }

    public function rotate($filename, $angle)
    {
        
        if (is_file($filename)) {

            $size = getimagesize($filename);

            switch($size['mime']) {
                case 'image/jpeg':
                    $source = imagecreatefromjpeg($filename);
                    break;
                case 'image/png':
                    $source = imagecreatefrompng($filename);
                    break;

                case 'image/gif':
                    $source = imagecreatefromgif($filename);
                    break;

                case 'image/vnd.wap.wbmp':
                    $source = imagecreatefromwbmp($filename);
                    break;
            }

            $rotate = imagerotate( $source, -1*$angle, 0 ) ;

            switch($size['mime']) {
                case 'image/jpg':
                case 'image/jpeg':
                    imagejpeg( $rotate, $filename );
                    break;
                case 'image/png':
                    imagepng( $rotate, $filename );
                    break;

                case 'image/gif':
                    imagegif( $rotate, $filename );
                    break;

                case 'image/vnd.wap.wbmp':
                    imagewbmp( $rotate, $filename );
                    break;
            }
        }

    }
}

?>