<!-- Tab panes Tools -->
<div class="tab-content">

    <?php if($data['tpl']=='owner') {?>
        <?= $this->render('_photo-owner', [
            'model'=>$data['photoModel'],
            'product_object_id'=>$data['model']->product_object_id,
        ]); ?>
    <?php } ?>


    <?php if($data['tpl']=='use') {?>
        <?= $this->render('_photo-use', [
            'model'=>$data['photoModel'],
        ]); ?>
    <?php } ?>


    <?= $this->render('_text', [
        'model'=>[],
    ]); ?>

    <?= $this->render('_backgraund', [
        'model'=>$data['cardBg'],
    ]); ?>

    <?= $this->render('_backside', [
        'model'=>$data['cardBg'],
    ]); ?>

    <?= $this->render('_envelope', [
        'model'=>$data['cardBg'],
    ]); ?>

    <?= $this->render('_rsvp', [
        'model'=>$data['cardBg'],
    ]); ?>


    <?= $this->render('_rsvp', [
        'model'=>$data['cardBg'],
    ]); ?>




    <div role="tabpanel" class="tab-pane" id="RSVP">RSVP</div>


</div>
<!-- end Tab panes Tools-->
