<?php
namespace frontend\widgets;

use common\models\Category;
use common\models\FaqCategory;
use frontend\models\SubscribeForNewsForm;
use Yii;
use yii\base\Widget;

/**
 * Class SubscribeForNews
 * @package frontend\widgets
 */
class TopCategory extends Widget
{
    public function run() {

        $model = Category::getMain();

        return $this->render('top-category', [
            'model'=>$model
        ]);
    }
}
