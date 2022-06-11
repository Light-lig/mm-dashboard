$(document).ready(function(){
    let latitud =   $('#mo_latitud').val();
    let longitud =    $('#mo_longitud').val();
    let map = L.map('map').setView([latitud, longitud], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);
   
    let  marker = L.marker([latitud, longitud]).addTo(map);
  
    
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

        $.ajax({url: `${contextpath}/municipios`, success: function(result){
            let selectMunicipios = $('#mun_id');
            let municipioSelected = selectMunicipios[0].attributes.municipio.value;
            let municipios = result;

            let dep_id = municipios.filter(el =>el.mun_id == municipioSelected)[0].dep_id;
            $.ajax({url: `${contextpath}/departments`, success: function(response){
                let select = $('#dep_id');
                response.forEach(item=>{
                    if((item.dep_id === dep_id)){
                        select.append($("<option />").val(item.dep_id).text(item.dep_nombre).attr("selected",''))

                    }else{
                        select.append($("<option />").val(item.dep_id).text(item.dep_nombre))

                    }
               })
              }});
            selectMunicipios.empty();
            selectMunicipios.append($("<option />").val('').text('Seleccione un municipio'));

            municipios.filter(el=>el.dep_id == dep_id).forEach(item=>{
                if((item.mun_id == municipioSelected)){
                    selectMunicipios.append($("<option />").val(item.mun_id).text(item.mun_nombre).attr("selected",''))

                }else{
                    selectMunicipios.append($("<option />").val(item.mun_id).text(item.mun_nombre))

                }
           })
          }});
       
    }
    getDepartments();

    $( "#dep_id" ).on( "change", function(e){
        $.ajax({url: `${contextpath}/municipios`, success: function(result){
            let select = $('#mun_id');
            select.empty();
            let depid = e.target.value;
            select.append($("<option />").val(0).text('Seleccione un municipio').attr("selected","selected"))

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

