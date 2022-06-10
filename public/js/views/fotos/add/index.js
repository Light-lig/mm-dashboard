$(document).ready(function(){

    $('#fh_foto').on('change',function(e){
      
        const [file] = $('#fh_foto').prop('files');
        const img = $('#blah');
        if (file) {

            img.attr('src',URL.createObjectURL(file)) ;
          }
    });
    
});
