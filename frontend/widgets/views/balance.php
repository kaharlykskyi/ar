<?php

$bit = "0";
$lit = "0";
$ethereum = "0";
$usd = "0";
$usd_ref = "0";

$bit_usd = "0";
$lit_usd = "0";
$ethereum_usd = "0";
$balanceUsd = "0";

$curBit = \common\models\Currency::findOne(\common\models\Currency::CUR_BIT);
$curLit = \common\models\Currency::findOne(\common\models\Currency::CUR_LIT);
$curEthereum = \common\models\Currency::findOne(\common\models\Currency::CUR_ETHEREUM);
$user = \Yii::$app->user->getIdentity();

if(isset($user->balance))
{
    $bit = round($user->balance->bit=="" ? 0:$user->balance->bit, 3);
    $lit = round($user->balance->lit=="" ? 0:$user->balance->lit, 3);
    $ethereum = round($user->balance->ethereum=="" ? 0:$user->balance->ethereum, 3);

    $usd = round($user->balance->usd=="" ? 0:$user->balance->usd);
    $usd_ref = round($user->balance->usd_ref=="" ? 0:$user->balance->usd_ref);

    $bit_usd = round($user->balance->bit * $curBit->curs);
    $lit_usd = round($user->balance->lit * $curLit->curs);
    $ethereum_usd = round($user->balance->ethereum * $curEthereum->curs);
    $balanceUsd = round($user->balance->usd + $bit_usd + $lit_usd + $ethereum_usd);


}


?>


    <div class="row">
        <div class="col-sm-12">
            <h4><?= \Yii::t('app', 'Ваш баланс') ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">


            <table class="table table-striped">
                <tbody>
                <tr>
                    <td><?= \Yii::t('app', 'Рубль') ?> [<span class="price" style="font-size:13px;"><i class="crypto-rub2"></i></span>]</td>
                    <td><strong class="<?= $user->balance->usd_status=="-" ? "go_down":"" ?> <?= $user->balance->usd_status=="+" ? "go_up":"" ?>"><?= \common\components\CFormatter::numberFormat($usd) ?></strong></td>
                    <td><a href="<?= \yii\helpers\Url::to(['/user/lk/payout'])?>" class="money-out"><?= \Yii::t('app', 'Вывод')?></a></td>
                    <td><a href="<?= \yii\helpers\Url::to(['/user/incoming/index'])?>" class="money-in"><?= \Yii::t('app', 'Пополнить') ?></a></td>
                </tr>

                <tr>
                    <td>Bitcoin [<img src="/img/icon-simple-bit.png">]</td>
                    <td><strong class="<?= $user->balance->bit_status=="-" ? "go_down":"" ?> <?= $user->balance->bit_status=="+" ? "go_up":"" ?>"><?= $bit ?></strong></td>
                    <td><a href="<?= \yii\helpers\Url::to(['/user/lk/payout-crypto', 'curency_id'=>\common\models\Currency::CUR_BIT])?>" class="money-out"><?= \Yii::t('app', 'Вывод')?></a></td>
                    <td><a href="<?= \yii\helpers\Url::to(['/user/lk/change', 'id'=>\common\models\Currency::CUR_BIT /*, 'val'=>$bit*/])?>" class="money-change"><?= \Yii::t('app', 'Обмен'); ?></a></td>
                </tr>

                <tr>
                    <td>Litcoin [<img src="/img/icon-simple-lit.png">]</td>
                    <td><strong class="<?= $user->balance->lit_status=="-" ? "go_down":"" ?> <?= $user->balance->lit_status=="+" ? "go_up":"" ?>"><?= $lit ?></strong></td>
                    <td><a href="<?= \yii\helpers\Url::to(['/user/lk/payout-crypto', 'curency_id'=>\common\models\Currency::CUR_LIT])?>" class="money-out"><?= \Yii::t('app', 'Вывод')?></a></td>
                    <td><a href="<?= \yii\helpers\Url::to(['/user/lk/change', 'id'=>\common\models\Currency::CUR_LIT /*, 'val'=>$lit*/])?>" class="money-change"><?= \Yii::t('app', 'Обмен'); ?></a></td>
                </tr>

                <tr>
                    <td>Ethereum  [<span class="price" style="font-size:16px;"><i class="crypto-eth"></i></span>]</td>
                    <td><strong class="<?= $user->balance->ethereum_status=="-" ? "go_down":"" ?> <?= $user->balance->ethereum_status=="+" ? "go_up":"" ?>"><?= $ethereum ?></strong></td>
                    <td><a href="<?= \yii\helpers\Url::to(['/user/lk/payout-crypto', 'curency_id'=>\common\models\Currency::CUR_ETHEREUM])?>" class="money-out"><?= \Yii::t('app', 'Вывод')?></a></td>
                    <td><a href="<?= \yii\helpers\Url::to(['/user/lk/change', 'id'=>\common\models\Currency::CUR_ETHEREUM /*, 'val'=>$ethereum*/])?>" class="money-change"><?= \Yii::t('app', 'Обмен'); ?></a></td>
                </tr>

                <?php if(1==2){ ?>
                    <tr>
                        <td>Рубль [<span style="font-size:13px;">реф</span>]</td>
                        <td><strong class="<?= $user->balance->usd_ref_status=="-" ? "go_down":"" ?> <?= $user->balance->usd_ref_status=="+" ? "go_up":"" ?>"><?= $usd_ref ?></strong></td>
                        <td><a href="<?= \yii\helpers\Url::to(['/user/lk/payout', 'type'=>'usd_ref'])?>" class="money-out"><?= \Yii::t('app', 'Вывод')?></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


        </div>
        <div class="col-sm-4" style="position: relative;margin-top: -15px;">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load("current", {packages: ["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Currency', 'Ballance'],
                        ['<?= \Yii::t('app', 'Рубли')?>', <?= $usd ?>],
                        ['Bitcoin', <?= $bit_usd ?>],
                        ['Litcoin', <?= $lit_usd ?>],
                        ['Еtherium', <?= $ethereum_usd ?>],
                        ['Рубли (реф)', <?= $usd_ref ?>]
                    ]);

                    var options = {
                        legend: 'none',
                        pieSliceText: 'label',
                        //title: 'Swiss Language Use (100 degree rotation)',
                        pieStartAngle: 100,
                        colors: ['#b9e986', '#f9b562', '#b0b0b0', '#b5d1ff', '#e9a8c2'],
                        fontName: 'TT-Supermolot',
                        fontSize: 12,
                        color: '#74787b',
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
            </script>

            <div id="piechart"></div>

        </div>

    </div>

    
    
    


