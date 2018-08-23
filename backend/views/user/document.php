
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User '.$model->fullname.' Applicant Documents');
$this->params['breadcrumbs'][] = $this->title;

$doc = \common\models\document\Document::find()
    ->where('document_type_id=:document_type_id', [
        ':document_type_id'=>\common\models\document\Document::DOCUMENT_TYPE_APPLICANT
    ])->all();

?>


<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered"><thead>
            <tr>
                <th>File Name</th>
                <th>attached</th>
            </thead>
            <tbody>
            <?php
            $ind=0;
            $docModel = $model->getUserDocument(\common\models\document\Document::DOCUMENT_TYPE_APPLICANT);
            $docArray = [];
            foreach($docModel as $item)
                $docArray[$item->name] = $item;
            ?>

            <?php foreach ($doc as $item) { ?>
                <tr data-key="<?= $ind ?>">
                    <td><?= \yii\bootstrap\Html::a('<i class="fa fa-file-pdf-o"></i> '.$item->name, $item->files[0]->fullPath, ['target'=>'_blanck']) ?></td>
                    <td>
                        <?php if(isset($docArray[$item->name]) && isset($docArray[$item->name]->files) && count($docArray[$item->name]->files)>0) { ?>
                            <?= \yii\bootstrap\Html::a('<i class="fa fa-file-pdf-o"></i> '.$item->name, $docArray[$item->name]->files[0]->fullPath, ['target'=>'_blanck']) ?>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>





