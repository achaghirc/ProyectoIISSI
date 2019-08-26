function validateEdition() {
    var noValidation = document.getElementById("#editaUsuario").novalidate;
    
    if (!noValidation){
        // Comprobar que la longitud de la contraseña es >=8, que contiene letras mayúsculas y minúsculas y números
        var error1 = validatePass();      
        var error6 = validateCif();
        var error2 = validateName();
        var error3 = validateEmail();
        var error4 = validateDirection();
        var error5 = validateTel();

        return (error1.length==0) && (error2.length==0) && (error3.length==0) && (error4.length==0) && (error5.length==0) && (error6.length==0);
    }
    else 
        return true;
}

function validateName() {
    
    var name = document.getElementById("NOMBRE");
    var nombre = name.value;

    if (nombre.length == 0) {
        var error = "Debe introducir un nombre";
    }else {
        var error = "";
    }
    name.setCustomValidity(error);
    return error;
}

function validateTel() {
    var exprNumero = /^([0-9])+$/;

    var telefonoCliente = document.getElementById("TELEFONO");
    var telefono = telefonoCliente.value;

    if (telefono.length == 0) {
        var error = "Introduzca un número de teléfono";
    } else if (!exprNumero.test(telefono)) {
        var error = "Un número de teléfono solo puede contener dígitos";
    } else if (telefono.length < 9) {
        var error = "Introduzca un número de teléfono válido";
    } else {
        var error = "";
    }
    telefonoCliente.setCustomValidity(error);
    return error;
}

function validateCif() {
    var cif = document.getElementById("CIF");
    var codigoCif = cif.value;

    if (codigoCif.length == 0) {
        var error = "Introduzca un código CIF";
    } else if (codigoCif.length != 9) {
        var error = "Introduzca un CIF válido";
    } else {
        var error = "";
    }
    cif.setCustomValidity(error);
    return error;
}

function validateEmail() {
    var exprEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 
    var correo = document.getElementById("CORREOELECTRONICO");
    var email = correo.value;

    if (email.length == 0) {
        var error = "Introduzca un email";
    } else if (!exprEmail.test(email)) {
        var error = "Introduzca un email válido";
    } else {
        var error = "";
    }
    correo.setCustomValidity(error);
    return error;
}

function validateDirection() {
    var direc = document.getElementById("DIRECCION");
    var direccion = direc.value;

    if (direccion.length == 0) {
        var error = "Introduzca una dirección";
    } else {
        var error = "";
    }
    direc.setCustomValidity(error);
    return error;
}

function validatePass(){
    var password = document.getElementById("CONTRASEÑA");
    var pwd = password.value;
    var valid = true;

    // Comprobamos la longitud de la contraseña
    valid = valid && (pwd.length>=8);
    
    // Comprobamos si contiene letras mayúsculas, minúsculas y números
    var hasNumber = /\d/;
    var hasUpperCases = /[A-Z]/;
    var hasLowerCases = /[a-z]/;
    valid = valid && (hasNumber.test(pwd)) && (hasUpperCases.test(pwd)) && (hasLowerCases.test(pwd));
    
    // Si no cumple las restricciones, devolvemos un error
    if(!valid){
        var error = "Por favor, introduzca una contraseña válida (longitud > 8), incluyendo al menos una letra minúscula, una mayúscula y un digito";
    }else{
        var error = "";
    }
    password.setCustomValidity(error);
    return error;
}

