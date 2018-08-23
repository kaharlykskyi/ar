

<div class="container" style="padding-top: 50px">
    <div class="row">
        <div class="large-left col-sm-12">
            <div class="row">
                <div id="center_column" class="center_column col-xs-12 col-sm-9 product-list">


                    <?php if(1==2) {?>
                        <div class="content_sortPagiBar clearfix">
                        <div class="sortPagiBar clearfix">
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
                                <div class="selector1">
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
                            <!-- /nbr product/page -->
                            <!-- /Sort country -->
                            <form id="productsSortForm" action="" class="productsSortForm SortCountry">
                                <div class="clearfix selector1">
                                    <label for="selectProductSort">Sort by country</label>
                                    <select id="selectProductSort" class="selectProductSort form-control">
                                        <option value="" selected="selected">--</option>
                                        <option value="">United Kingdom</option>
                                        <option value="">Austria</option>
                                        <option value="">Germany</option>
                                        <option value="">USA</option>
                                        <option value="">France</option>
                                        <option value="">Switzerland</option>
                                        <option value="">Sweden</option>
                                    </select>
                                </div>
                            </form>
                            <!-- /Sort country -->
                        </div>
                    </div>
                    <?php } ?>


                    <?= $this->render('_result', [
                        'dataProvider'=>$dataProvider,
                        'model'=>$model,
                    ]) ?>
                    
                    

                    
                    <?php if(1==2) { ?>
                        <!-- hide text -->
                        <div class="category-hide-txt">
                            <h4>Lorem ipsum dolor</h4>
                            <div class="view-source">
                                <a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe quos provident tenetur dolorem fugit velit necessitatibus illum, maiores, pariatur est atque harum aut aperiam quidem, accusamus. Illum nisi nostrum corrupti...<i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                <div class="hide-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus labore quibusdam voluptates, omnis, quos tempore asperiores totam non ipsam quas iure, libero quis! Sit optio obcaecati tenetur nostrum. Blanditiis, veritatis. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non quis sequi aperiam illo nesciunt quisquam quo tenetur, praesentium quod voluptate tempora quasi dicta fugiat accusamus illum itaque explicabo laudantium dolor.</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <br>
                    <br>
                    <!-- hide text: end -->
                </div>
                <!-- #center_column -->
                
                
                <div id="left_column" class="column col-xs-12 col-sm-3">
                    <section id="layered_block_left" class="block">

                        <h4 class="title_block"><?= e($category->parent->name) ?></h4>
                        <div class="block_content">
                            <div class="layered_filter">
                                <div class="block_content list-block" style="">
                                    <ul>
                                        <?php foreach ($category->parent->child as $sub) { ?>
                                            <li>
                                                <a href="<?= url(['/category/index', 'id'=>$sub->id]) ?>" title="Addict "><?= e($sub->name) ?></a>
                                            </li>
                                        <?php }  ?>

                                    </ul>
                                </div>
                            </div>

                            <?= \frontend\widgets\CategoryBanner::widget([
                            ]) ?>


                        </div>
                        
                    </section>
                </div>
            </div>
            <!--.large-left-->
        </div>
        <!--.row-->
    </div>
    <!-- .row -->
</div>