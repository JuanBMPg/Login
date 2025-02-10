
let id =" <?php echo $id ?>"

$(document).ready(function() {
    // Capturar el formulario y enviarlo por AJAX
    $("#formularioPeticion").submit(function(e) {
        e.preventDefault(); // Evitar el envío normal del formulario

        let form = new FormData(this);
        let actionUrl = "crearPeticion.php";

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form,
            success: function(data) {
                $('#ex1').modal('show');
            },
            // Mostrar el modal después de procesar la petición
            cache: false,
            contentType: false,
            processData: false


        });
    });

    // Capturar el click en el botón de enviar email dentro del modal
    $("#Si").click(function() {
        window.location.href = `enviarMail.php?id=${id}`;
    });

    $("#No").click(function() {
        window.location.href = "listadoPeticiones.php";
    })
});