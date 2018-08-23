<?php
use \yii\widgets\Pjax;
?>

<?php
Pjax::begin([
    'enablePushState' => false,
    'timeout' => 5000,
    'id' => 'signup'
]);
$model = new \common\models\LoginForm();
// $model->referal = \Yii::$app->request->get('ref', '');
?>

    <?= $this->render('_login', [
        'model' => $model,
    ]) ?>

<?php
Pjax::end();
?>
