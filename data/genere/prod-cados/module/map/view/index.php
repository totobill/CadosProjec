<div id="basic_map"></div>
    <p>Bonjour</p>
    <script type=text/javascript>    /**
  * Basic Map
  */
$(document).ready(function(){
 var map = new GMaps({
    el: '#basic_map',
    lat: 51.5073346,
    lng: -0.1276831,
    zoom: 12,
    zoomControl : true,
    zoomControlOpt: {
        style : 'SMALL',
        position: 'TOP_LEFT'
    },
    panControl : false
  });
});
</script>

