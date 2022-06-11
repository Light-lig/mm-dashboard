$(document).ready(function(){
    let map = L.map('map').setView([13.69, -89.19], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([13.69, -89.19]).addTo(map);
    $('#mo_latitud').val(13.69,);
    $('#mo_longitud').val(-89.19);
    
    marker.on('dragend', function(event){
        var marker = event.target;
        var position = marker.getLatLng();
        marker.setLatLng(new L.LatLng(position.lat, position.lng),{draggable:'true'});
        map.panTo(new L.LatLng(position.lat, position.lng))
      });
      map.addLayer(marker);
    function onMapClick(e) {
        $('#mo_latitud').val(e.latlng.lat);
        $('#mo_longitud').val(e.latlng.lng);
        marker.setLatLng([e.latlng.lat,e.latlng.lng])
    }
    map.on('click', onMapClick);

    function getDepartments(){
        $.ajax({url: `${contextpath}/departments`, success: function(result){
            let select = $('#dep_id');
            let val = $('#dep_id').val();
           result.forEach(item=>{
               select.append($("<option />").val(item.dep_id).text(item.dep_nombre))
           })
          }});
    }
    getDepartments();

    $( "#dep_id" ).on( "change", function(e){
        $.ajax({url: `${contextpath}/municipios`, success: function(result){
            let select = $('#mun_id');
            select.empty();
            let depid = e.target.value;
            select.append($("<option />").val('').text('Seleccione un municipio').attr("selected","selected"))

           result.filter(el=>el.dep_id == depid).forEach(item=>{
               select.append($("<option />").val(item.mun_id).text(item.mun_nombre))
           })
          }});
    } );

    $('#mo_foto_portada').on('change',function(e){
      
        const [file] = $('#mo_foto_portada').prop('files');
        const img = $('#blah');
        if (file) {

            img.attr('src',URL.createObjectURL(file)) ;
          }
    });

});

