<div class="row bg-menu clearfix">
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 static">
        <div class="module ">
            <div class="top_menu top-level tmmegamenu_item">
                <div class="menu-title tmmegamenu_item">Menu</div>
                <ul class="menu clearfix top-level-menu tmmegamenu_item">
                    <?php foreach($model as $category) {?>
                    <li class=" simple top-level-menu-li tmmegamenu_item"><a class="top-level-menu-li-a tmmegamenu_item" href="javascript:;"><?= e($category->name) ?></a>
                        <ul class="is-simplemenu tmmegamenu_item first-level-menu">
                            <?php foreach($category->child as $sub) { ?>
                                <li class="category">
                                    <a href="<?= url(['/category/index', 'id'=>$sub->id]) ?>" title="Addict "><?= e($sub->name) ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </div>
    <?php if(1==2) { ?>
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 ">
        <div class="module ">
            <div class="clearfix">
                <div id="tmsearch">
                    <i class="current"></i>
                    <form id="tmsearchbox" method="get" action="#">
                        <input type="hidden" name="fc" value="module" />
                        <input type="hidden" name="controller" value="tmsearch" />
                        <input type="hidden" name="module" value="tmsearch" />
                        <input type="hidden" name="orderby" value="position" />
                        <input type="hidden" name="orderway" value="desc" />
                        <select name="search_categories" class="form-control">
                            <option value="2">All Categories</option>
                            <option value="12">--Women&rsquo;s </option>
                            <option value="22">---Body Products</option>
                            <option value="27">----Shower Gels</option>
                            <option value="28">----Deodorants</option>
                            <option value="29">----Body Lotions</option>
                            <option value="30">----Hand Creams</option>
                            <option value="31">----Body Mists</option>
                            <option value="32">----Body Milks</option>
                            <option value="23">---Luxury Perfumes</option>
                            <option value="33">----Addict </option>
                            <option value="34">----Amber</option>
                            <option value="35">----Black Opium</option>
                            <option value="36">----Bvlgari Pour Femme</option>
                            <option value="37">----J&#039;adore</option>
                            <option value="38">----Miss Dior</option>
                            <option value="24">---Designer Perfumes</option>
                            <option value="39">----Anna Sui </option>
                            <option value="40">----Armani</option>
                            <option value="41">----Calvin Klein</option>
                            <option value="42">----Carolina Herrera</option>
                            <option value="43">----Dolce&amp;Gabbana</option>
                            <option value="44">----Marc Jacobs</option>
                            <option value="25">---Classic Perfumes</option>
                            <option value="45">----Classique</option>
                            <option value="46">----5th Avenue</option>
                            <option value="47">----Amarige</option>
                            <option value="48">----Diorella</option>
                            <option value="49">----Dolce Vita</option>
                            <option value="50">----White Diamonds</option>
                            <option value="26">---Celebrity Perfumes</option>
                            <option value="51">----Beyonc&eacute;</option>
                            <option value="52">----Britney Spears</option>
                            <option value="53">----Jennifer Lopez</option>
                            <option value="54">----Rihanna</option>
                            <option value="55">----Sarah Jessica Parker</option>
                            <option value="56">----Beckham</option>
                            <option value="13">--Men&rsquo;s </option>
                            <option value="14">--Unisex</option>
                            <option value="15">--Deodorants and Body Sprays</option>
                            <option value="16">--Luxury Gift Sets</option>
                            <option value="17">--Clearance</option>
                            <option value="18">--Exclusives</option>
                            <option value="19">--Body Washes</option>
                            <option value="20">--Skin Care</option>
                            <option value="21">--Mini Fragrances</option>
                        </select>
                        <input class="tm_search_query form-control" type="text" id="tm_search_query" name="search_query" placeholder="Search" value="" />
                        <button type="submit" name="tm_submit_search" class="btn btn-default button-search">
                            <span>Search</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</div>

