<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$confirmLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-email', 'token' => $model->auth_key]);
?>

<?= $this->render('common/header'); ?>
<table width="100%" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;">
    <tr>
        <td class="cell text" style="color: #8a8a8a; font-family: 'Roboto', 'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 20px; padding: 10px; padding-left: 7%; padding-right: 7%; padding-top: 12px; text-align: left;">
            <p>
                <?= \Yii::t('app', 'Здравствуйте') ?>, <?= $model->username ?><br>
                <?= \Yii::t('app', 'Спасибо, что выбрали нас.') ?>
            </p>
        </td>
    </tr>
    <tr>
        <td class="cell text" style="color: #8a8a8a; font-family: 'Roboto', 'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 20px; padding: 10px; padding-left: 7%; padding-right: 7%; padding-top: 12px; text-align: left;">
            Ваш аккаунт активирован. Перейдите по ссылке, чтобы подтвердить email.
        </td>
    </tr>
    <tr>
        <td class="cell" style="border-bottom: 1px solid #d4d4d4; padding: 10px; padding-bottom: 44px; padding-top: 38px; text-align: left;">
            <div align="center" style="margin: 0 auto;"><!--[if mso]>
                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="<?= $confirmLink ?>" style="height:45px;v-text-anchor:middle;width:198px;" stroke="f" fillcolor="#fecf56">
                    <w:anchorlock/>
                    <center style="color:#333333;font-family:arial,sans-serif;font-size:13px;font-weight:normal;">Подтвердить</center>
                </v:rect>
                <![endif]-->
                <a href="<?= $confirmLink ?>" target="_blank" style="-webkit-text-size-adjust: none; background-color: #fecf56; color: #333333; display: inline-block; font-family: 'Roboto','Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: normal; line-height: 45px; mso-hide: all; text-align: center; text-decoration: none; width: 198px;">Подтвердить</a></div>
        </td>
    </tr>
    <tr>
        <td class="cell f_l" style="color: #000000; font-family: 'Roboto', 'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 15px; height: 104px; line-height: 25px; padding: 10px; text-align: center;">
            <a href="<?= \Yii::$app->params['www'] ?>" target="_blank" style="color: #000000; text-decoration: underline;"><?= \Yii::$app->params['domen'] ?></a>
        </td>
    </tr>
</table>

<?= $this->render('common/footer'); ?>

