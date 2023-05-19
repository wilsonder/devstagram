import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {

    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function() { //funcion para que muestre el valor de la imagen ene le dropezone
        if(document.querySelector('[name="imagen"]').value.trim()) { //si hay una imagen carga en el dropzone
            const imagenPublicada = {}
            imagenPublicada.size = 1234; //size aleatorio
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`); //aqui llamamos la carpeta donde se va a guardar la imagen
            imagenPublicada.previewElement.classList.add("dz-success","dz-complete"); //dz calse propia de dropzone

        }
    }
});


//eventos de dropzone para debuggear los sucesos que pasan alli al subir una imagen

dropzone.on("success", function(file,response) {
    document.querySelector('[name="imagen"]').value = response.imagen; //en esta line asignamos el valor de la imagen al input oculto del create.blade
});


dropzone.on("removedfile", function() {
    console.log('Archivo Eliminado');
});

dropzone.on("removedfile", function() {
    document.querySelector('[name="imagen"]').value = ""; 
});