import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Arrastra tus archivos o haz click para subirlos.",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar archivo",
    maxFiles: 1,
    uploadMultiple: false,
});

dropzone.on("sending", (file, xhr, formData) => {
    console.log(file, xhr, formData);
});

dropzone.on("success", (file, response) => {
    console.log(file, response);
});

dropzone.on("error", (file, message) => {
    dropzone.removeFile(message);
});

dropzone.on("removedfile", (file) => {
    dropzone.removeFile(file);
})
