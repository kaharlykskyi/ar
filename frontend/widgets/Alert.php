<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;

/**
 * Class SubscribeForNews
 * @package frontend\widgets
 */


class Alert extends Widget
{
    public $alertTypes = [
        'error'   => 'calert-danger',
        'danger'  => 'calert-danger',
        'success' => 'calert-success',
        'success-pay' => 'calert-success',
        'success-reg' => 'calert-success',
        'info'    => 'calert-info',
        'warning' => 'calert-warning'
    ];

    public function run() {

        $session = Yii::$app->session;
        $model = $session->getAllFlashes();

        return $this->render('alert', [
            'model' => $model,
            'alertTypes' => $this->alertTypes
        ]);
    }
}
