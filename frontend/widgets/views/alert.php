<?php if(count($model)>0) { ?>
    <script type="text/template" class="calert-item">
        <?php
        $session = Yii::$app->session;

        foreach ($model as $type => $data) {

            if (isset($alertTypes[$type])) {

                if(is_string($data))
                {
                    $data = (array) $data;
                }

                echo '<div>';
                echo '<div>';
                echo '<h4 class="'.$alertTypes[$type].'" data-action="'.$type.'">';
                foreach ($data as $i => $message) {
                    if(is_numeric($i))
                        echo "<p>".$message.'</p>';
                }
                echo '</h4>';
                echo '</div>';

                foreach ($data as $i => $message) {
                    if(!is_numeric($i))
                        echo \yii\bootstrap\Html::a($i, $message);
                }

                echo '</div>';
                $session->removeFlash($type);
            }
        }
        ?>
    </script>
<?php } ?>

<?php
$this->registerJsFile('/js/CAlert.js?_='.\Yii::$app->params['version'], [
    'depends' => ['yii\web\JqueryAsset']
]);
?>

