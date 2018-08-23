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
class LimitedOffers extends Widget
{
    public function run() {
        
        return $this->render('limited-offers', [
        ]);
    }
}
