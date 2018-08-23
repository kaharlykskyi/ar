<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$confirmLink = "";
if(isset($model['id']) && $model['id']!="")
    $confirmLink = \Yii::$app->urlManager->createAbsoluteUrl(['/event/index', 'id' => $model['id']]);

if(isset($model['event_id']) && $model['event_id']!="")
    $confirmLink = \Yii::$app->urlManager->createAbsoluteUrl(['/event/index', 'event_id' => $model['event_id']]);

?>


<?= $this->render('common/header'); ?>

<table width="528" height="740" border="0" cellspacing="0" cellpadding="0" style="background: url('<?= \Yii::$app->params['www'] ?>/img/envelope_email.png')">
    <tbody>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td height="270" align="center">
            <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:'Times New Roman'">
                <tbody>
                <tr>
                    <td align="center" valign="middle" height="70" style="font-size: 24px; text-transform: uppercase;  "><?= $model['event']->event_name ?></td>
                </tr>
                <tr>
                    <td align="center" valign="middle" height="90" style="font-size: 18px;line-height: 28px;">
                        <?= $model['name']?>
                        <p><?= date('F j, Y', $model['event']->date_to_send) ?>, start: <?= $model['event']->start_date ?>, end: <?= $model['event']->end_date ?></p>
                        <p><?= $model['event']->address ?></p>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle">
                        <a href="<?= $confirmLink ?>" style="padding: 13px 11px; background-color: #000; font-size: 13px; display: inline-block; border-radius: 7px; color: #fff; text-decoration: none; text-transform: uppercase;">view the card</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td height="280">&nbsp;</td>
    </tr>
    </tbody>
</table>

<?= $this->render('common/footer', [
    'model'=>$model
]); ?>




