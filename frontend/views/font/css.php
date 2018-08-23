<?php
exit;
header("Content-Type: text/css;X-Content-Type-Options: nosniff;");
// header("Content-type: text/css; charset: UTF-8");
?>

<?php foreach ($model as $font) { ?>
    <?php foreach ($font->fontStyle as $item) { ?>

@font-face {
    font-family: '<?= $font->name ?>';
    font-style: <?= $item->font_style=="0" ? "normal":"italic" ?>;
    font-weight: <?= $item->font_weight=="0" ? "normal":"bold" ?>;
    <?php if(1==2){ ?>
        src: url('<?= $item->files[0]->fullPath ?>') format('truetype');
    <?php } ?>
    src: url('<?= Yii::getAlias('@repository_www').\Yii::$app->params['fontPath'].$item->path ?>') format('truetype');
}

    <?php } ?>
<?php } ?>

<?php exit; ?>
