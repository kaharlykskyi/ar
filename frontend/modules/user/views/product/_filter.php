
<div class="content_sortPagiBar clearfix">
    <div class="sortPagiBar clearfix">
        <?php if(1==2) { ?>
            <form id="productsSortForm" action="" class="productsSortForm">
                <div class="select selector1">
                    <label for="selectProductSort">Sort by</label>
                    <select id="selectProductSort" class="selectProductSort form-control">
                        <option value="position:asc" selected="selected">--</option>
                        <option value="price:asc">Price: Lowest first</option>
                        <option value="price:desc">Price: Highest first</option>
                        <option value="name:asc">Product Name: A to Z</option>
                        <option value="name:desc">Product Name: Z to A</option>
                        <option value="quantity:desc">In stock</option>
                        <option value="reference:asc">Reference: Lowest first</option>
                        <option value="reference:desc">Reference: Highest first</option>
                    </select>
                </div>
            </form>
            <!-- /Sort products -->
            <!-- nbr product/page -->
            <form action="" method="get" class="nbrItemPage">
                <div class="clearfix selector1">
                    <label for="nb_item">
                        Show
                    </label>
                    <input type="hidden" name="id_lang" value="1" />
                    <input type="hidden" name="id_category" value="12" />
                    <input type="hidden" name="controller" value="category" />
                    <select name="n" id="nb_item" class="form-control">
                        <option value="6" selected="selected">6</option>
                        <option value="12">12</option>
                        <option value="30">30</option>
                    </select>
                    <span>per page</span>
                </div>
            </form>
        <?php } ?>
        <!-- /nbr product/page -->
        <div class="promote-button addgoods-button">
            <?= \yii\helpers\Html::a('Add goods', ['/user/product/create'], ['class'=>'btn btn-sm btn-base']) ?>
        </div>
    </div>
</div>