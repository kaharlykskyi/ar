<?php foreach($fonts as $item) { ?>

    <div class="c-font-item j-font-item" data-font="<?= $item->name ?>">
        <span style="font-family: <?= $item->name ?>; ">Birthday</span>
    </div>

<?php } ?>