<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

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
                    <td align="center" valign="middle" height="70" style="font-size: 24px; text-transform: uppercase;  "></td>
                </tr>
                <tr>
                    <td align="center" valign="middle">
                        test email
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



