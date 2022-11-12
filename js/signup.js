var ocultar = document.getElementsByClassName("emailexist");

if (ocultar.style.display === "none") {
    ocultar.style.display = "block";
} else {
    x.style.display = "none";
}

$(function () {

    $("form[name='signup']").validate({

        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {

            name: "Por favor, introduzca su nombre",

            password: {

                required: "Por favor proporcione una contraseña",

                minlength: "Su contraseña debe tener al menos 5 caracteres."

            },

            email: "Por favor, introduce una dirección de correo electrónico válida"

        },

        submitHandler: function (form) {

            form.submit();

        }
    });


});