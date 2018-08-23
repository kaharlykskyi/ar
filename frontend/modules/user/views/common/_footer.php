</div>
<!-- .container -->
</div>
<!-- #columns -->
</div>

<?php
$this->registerJsFile('/js/CUser.js?_='.\Yii::$app->params['version'], [
    'depends' => ['yii\web\JqueryAsset']
]);
?>