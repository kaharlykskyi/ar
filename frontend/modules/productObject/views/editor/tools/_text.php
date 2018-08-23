<div role="tabpanel" class="tab-pane text_style" id="j-tools-text" xmlns="http://www.w3.org/1999/html">
    <!-- Nav tabs -->
    <div class="pg15">
        <a href="javascript:;" class="btn btn-default j-add-text">Add Text</a>
        <a href="javascript:;" class="btn btn-default j-delete-text">Delete Text</a>
        <br>
        <hr>
        <ul class="nav nav-tabs text_style_tab" role="tablist">
            <li role="presentation" class="active"><a href="#Styling" aria-controls="Styling" role="tab" data-toggle="tab">Styling</a></li>
            <li role="presentation"><a href="#Fonts" aria-controls="Fonts" role="tab" data-toggle="tab">Fonts</a></li>
            <li role="presentation"><a href="#Colors" aria-controls="Colors" role="tab" data-toggle="tab">Colors</a></li>
        </ul>
    </div>

    <!-- Tab panes -->
    <div class="tab-content tab-content-text">
        <div role="tabpanel" class="tab-pane active pg15" id="Styling">
            
            <div class="text_style_bl_title">
                <span >Size</span>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="range_slider j-text-font-size-block">
                        <a href="javascript:;" class="down"></a>
                        <input type="range" id="j-text-font-size" max="100" min="8" value="20">
                        <a href="javascript:;" class="up"></a>
                    </div>
                </div>
            </div>
            <div class="text_style_bl_title">
                <span >Letter Spacing</span>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="range_slider j-tools-text-letter-spacing-block">
                        <a href="javascript:;" class="down"></a>
                        <input type="range" id="j-tools-text-letter-spacing" max="40" min="1" value="5" >
                        <a href="javascript:;" class="up"></a>
                    </div>

                </div>
            </div>
            <div class="text_style_bl_title">
                <span >Line Height</span>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="range_slider j-tools-text-line-height-block">
                        <a href="javascript:;" class="down"></a>
                        <input type="range" id="j-tools-text-line-height" max="20" min="1" value="4">
                        <a href="javascript:;" class="up"></a>
                    </div>
                </div>
            </div>
            <div class="text_style_bl_title">
                <span >Alignment</span>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="align_list" id="j-tools-text-align">
                        <li><a href="javascript:;" class="align_left" data-param="left"></a> </li>
                        <li><a href="javascript:;" class="align_center" data-param="center"></a> </li>
                        <li><a href="javascript:;" class="align_right" data-param="right"></a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane scroll" id="Fonts">

            <?php $fonts = \common\models\font\Font::find()->limit(30)->all(); ?>

            <div class="font-list">
                <?= $this->render('_font', [
                    'fonts'=>$fonts,
                ]); ?>
            </div>

            <?= $this->render('_fontcss', [
                'fonts'=>$fonts,
            ]); ?>

        </div>
        <div role="tabpanel" class="tab-pane scroll" id="Colors">
            <ul class="text_color_list" id="j-tools-text-color">

                <?php
                $colors = ['#000000', '#Ffffff', '#696969', '#808080', '#a9a9a9', '#c0c0c0', '#d3d3d3', '#dcdcdc', '#f5f5f5', '#800000', '#c30202', '#fb0000', '#8b0000', '#ebeb05', '#ff0000', '#ff8c00', '#ff4500', '#ffa500', '#ffd700', '#a4a401', '#ffff00', '#b8860b', '#adff2f', '#9acd32', '#32cd32', '#8fbc8f', '#90ee90', '#98fb98', '#f0fff0', '#00ff7f', '#00fa9a', '#20b2aa', '#2e8b57', '#3cb371', '#2adfcd', '#2dd3cd', '#51cba2', '#7fffd4', '#f5fffa', '#008080', '#008b8b', '#00ffff', '#00ced1', '#00bfff', '#00bfff', '#12126e', '#000080', '#00008b ', '#0000ff', '#0000cd', '#4169e1', '#1e90ff', '#6495ed', '#2d77b5', '#489b9e', '#2f4f4f', '#778899', '#6b8e23', '#556b2f', '#228b22', '#7cfc00', '#006400', '#87ceeb', '#87cefa', '#b0c4de', '#add8e6', '#b0e0e6', '#afeeee', '#e6e6fa', '#e0ffff', '#f8f8ff', '#fffafa', '#9932cc', '#fffff0', '#fffaf0', '#fff5ee', '#ffe4e1', '#f5f5dc', '#4b0082', '#9400d3', '#8a2be2', '#800080', '#9370db', '#40338e', '#7b68ee', '#6a5acd', '#b84ad3', '#8b008b', '#ff00ff', '#dc143c', '#c71585', '#de668d', '#da70d6', '#dda0dd', '#ff69b4', '#ffc0cb', '#ff1493', '#ffb6c1', '#fff0f5', '#e9967a', '#fa8072', '#f4a460', '#ff7f50', '#ff6347', '#cd5c5c', '#b22222', '#d2691e', '#8b4513', '#bb8500', '#898d8c', '#765d59', '#694d42', '#ab8f83', '#d1b08d', '#c2bfb8 ', '#faebd7', '#f5f5dc', '#ffffe0', '#ffe4e1', '#afaeaa', '#c8c7b3', '#c9b092', '#4d3873', '#766086', '#4e72a6', '#0a8ac7', '#9990bb', '#d3a4d8', '#bfdff6', '#c7c7eb', '#009a9f', '#04afa9', '#72dfbf', '#51d1dc', '#dad5ab', '#fcd89e', '#fba35b', '#c35b5a', '#a10f15', '#ffd4c1', '#fdbcaa', '#ff9886', '#f06b88', '#f4c0ab', '#feb4f1 ', '#ffff00', '#603913', '#754c24', '#8c6239', '#a67c52', '#c69c6d', '#534741', '#362f2d', '#736357', '#998675 ', '#c7b299', '#ffa07a', '#ff4900', '#f08080', '#d2b48c', '#d2b48c', '#f9ee90', '#bc8f8f', '#ffdead', '#f5deb3', '#ffe4b5', '#ffdab9', '#ffe4c4', '#ffebcd', '#fffacd', '#fafad2', '#ffefd5'];
                ?>
                <?php foreach ($colors as $color) { ?>
                    <li><a href="jabascript:;" data-param="<?= $color ?>" class="" style="background-color: <?= $color ?>"></a></li>
                <?php } ?>
            </ul>
        </div>

    </div>
</div>
