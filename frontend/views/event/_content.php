<?php

use \yii\bootstrap\ActiveForm;

?>

<!--
animation
.bl_envelope   bottom:-700px(kam -50%)
.laer2         bottom:700px(kam 50%)
%-ov dnelu depqum mobilei harcy lucvuma
 -->
<div class="container_contact">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-12"><div class="contact_h1"><span><?= $model->event_name ?></span></div></div>
                </div>


                <div class="row">
                    <div class="col-md-12"><div class="small_text">from:</div></div>
                </div>

                
                <div class="row">
                    <div class="col-md-12"><div class="contact_h1"><span><?= $model->host_name ?></span></div></div>
                </div>
                <div class="row">
                    <div class="col-md-12"><div class="small_text"><?= $model->notes ?></div></div>
                </div>

            </div>
        </div>
    </div>
    <div class="bl_yellow_final">
        <div class="container">
            <div class="row">
                <div class="col-md-2  col-md-offset-1">
                    <div class="bl_yellow_info">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="bl_yellow_info">
                        <div class="yellow_title">Date</div>
                        <div class="yellow_date"><?= date('F j, Y', $model->date_to_send) ?></div>
                        <div class="yellow_time"><?= $model->start_date ?>-<?= $model->end_date ?></div>
                        <!-- div><a href="#" class="a_underblack">ADD TO CALENDAR </a> </div -->

                        <div class="yellow_address"><?= $model->address ?> </div>
                    </div>
                </div>
                <div class="col-md-2 col-md-offset-1">
                    <div class="bl_yellow_info">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="map" style="min-height: 400px; width: 100%" >

</div>

<div class="container_contact">
    <footer class="footer_final">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="footer_logo"><img src="/img/logo.png"></span>
                    <span class="footer_logo">&copy; 2018. All rights reserved - <a href="" class="a_underblack">artviza.com</a></span>
                </div>
            </div>
        </div>
    </footer>
</div>


<script>
    function initMaps() {
        //28 King St Birmingham B11 1SG UK
        $.ajax({
            url: "https://maps.googleapis.com/maps/api/geocode/json?address=<?= $model->address ?>&key=<?= \Yii::$app->params['googlemap-key']; ?>",
            type: "get",
            dataType: "json",
            data: {},
            _self:$(this),
            success: function(data) {

                console.log(data.results);
                console.log();
                // console.log(data.results.geometry['location']);

                var map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 15,
                    styles: [{"elementType": "geometry","stylers": [{"color": "#f5f5f5"}]},{"elementType": "labels.icon","stylers": [{"visibility": "off"}]},{"elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},{"elementType": "labels.text.stroke","stylers": [{"color": "#f5f5f5"}]},{"featureType": "administrative.land_parcel","elementType": "labels.text.fill","stylers": [{"color": "#bdbdbd"}]},{"featureType": "poi","elementType": "geometry","stylers": [{"color": "#eeeeee"}]},{"featureType": "poi","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},{"featureType": "poi.park","elementType": "geometry","stylers": [{"color": "#e5e5e5"}]},{"featureType": "poi.park","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]},{"featureType": "road","elementType": "geometry","stylers": [{"color": "#ffffff"}]},{"featureType": "road.arterial","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},{"featureType": "road.highway","elementType": "geometry","stylers": [{"color": "#dadada"}]},{"featureType": "road.highway","elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},{"featureType": "road.local","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]},{"featureType": "transit.line","elementType": "geometry","stylers": [{"color": "#e5e5e5"}]},{"featureType": "transit.station","elementType": "geometry","stylers": [{"color": "#eeeeee"}]},{"featureType": "water","elementType": "geometry","stylers": [{"color": "#c9c9c9"}]},{"featureType": "water","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]}],
                    center: data.results[0].geometry['location'],
                    draggable: !0,
                    scrollwheel: !0
                }), infowindow = new google.maps.InfoWindow({content: "<b><?= $model->address ?></b>"}), marker = new google.maps.Marker({
                    position: data.results[0].geometry['location'],
                    map: map, icon: "/img/marker.png"
                });
                marker.addListener("click", function () {
                    infowindow.open(map, marker)
                })

            },
            error: function(response) {
                alert('error');
            }
        });



    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?= \Yii::$app->params['googlemap-key']; ?>&amp;language=en&amp;region=en&amp;callback=initMaps" async defer></script>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>