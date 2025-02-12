import Dropzone from "dropzone";
 
Dropzone.autoDiscover = false;
  
const dropzone = new Dropzone(".dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1, //cuantas fotos pueden subir
        //maxFilesize:5, //tamaño maximo de imagen mb
        uploadMultiple: false,

        init: function(){
                if(document.querySelector('[name="imagen"]').value.trim()){
                      const  imagenPublicada= {}
                      imagenPublicada.size = 1500 // este valor es necesario pero puede ser otro
                      imagenPublicada.name =document.querySelector('[name="imagen"]').value // le pasamos el nombre que estamosm obteniedo 
                        
                      this.options.addedfile.call(this, imagenPublicada) //opciones de dropzone call se manda a llamar cuando se inicia dropzone y con bind lo tienes  que mandar a llamar 
                      this.options.thumbnail.call(this, imagenPublicada,`/uploads/${imagenPublicada.name}`) //para obtener la imagen que tenga

                      
                      imagenPublicada.previewElement.classList.add("dz-success","dz-complete")
                
                
                }
        }
});

//funcion cuando esta enviando un archivo
/*dropzone.on('sending', function (file, xhr, formData) {
        console.log(file);
})*/


//funcion cuando se suba correctamente
dropzone.on('success', function(file, response){
        //console.log(response.imagen);
        document.querySelector('[name="imagen"]').value = response.imagen;
})

//funcion cuando sepas que esta bien el back-end pero no se suba 
/*dropzone.on('error', function(file, message){
        console.log(message);
})*/

/*dropzone.on('removedfile', function(file, message){
        console.log('archivo eliminado');
})*/
dropzone.on('removedfile', function(){
        document.querySelector('[name="imagen"]').value= ""
})