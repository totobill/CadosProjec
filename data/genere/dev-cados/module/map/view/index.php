<div id="basic_map">
    
    <div id="mouse_event_map"></div>
</div>

<script>
    /**
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
        panControl : false,
      });
    });

    /**
    * Mouse Events on Maps
    */
    $(document).ready(function(){
     var map = new GMaps({
        el: '#mouse_event_map',
        lat: 51.5073346,
        lng: -0.1276831,
        zoom: 12,
        zoomControl : true,
        zoomControlOpt: {
            style : 'SMALL',
            position: 'TOP_LEFT'
        },
        panControl : false,
        click: function(e){
          alert('Click event');
        },
        dragend: function(e){
          alert('Drag Event');
        }
      });
</script>