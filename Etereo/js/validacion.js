function validateForm() {
    var noValidation = document.getElementById("#altaUsuario").novalidate;
    
    if (!noValidation){
        // Comprobar que la longitud de la contraseña es >=8, que contiene letras mayúsculas y minúsculas y números
        var error1 = validarContraseña();      
        var error2 = validarConfirmacion();
        var error6 = validaCif();
        var error7 = validaNombre();
        var error3 = validaEmail();
        var error4 = validaDireccion();
        var error5 = validaTelefono();

        return (error1.length==0) && (error2.length==0) && (error3.length==0) && (error4.length==0) && (error5.length==0) && (error6.length==0) && (error7.length==0);
    }
    else 
        return true;
}

function validaNombre() {
    var exprNumero = /^([0-9])+$/;

    var name = document.getElementById("nombre");
    var nombre = name.value;

    if (nombre.length == 0) {
        var error = "Introduzca su nombre de empresa";
    }else {
        var error = "";
    }
    name.setCustomValidity(error);
    return error;
}


function validaTelefono() {
    var exprNumero = /^([0-9])+$/;

    var telefonoCliente = document.getElementById("telCliente");
    var telefono = telefonoCliente.value;

    if (telefono.length == 0) {
        var error = "Introduzca su número de teléfono";
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


function validaCif() {
    var cif = document.getElementById("cif");
    var codigoCif = cif.value;

    if (codigoCif.length == 0) {
        var error = "Introduzca su código CIF";
    } else if (codigoCif.length != 9) {
        var error = "Introduzca un CIF válido";
    } else {
        var error = "";
    }
    cif.setCustomValidity(error);
    return error;
}
function validaEmail() {
    var exprEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 
    var correo = document.getElementById("correoElectronico");
    var email = correo.value;

    if (email.length == 0) {
        var error = "Introduzca su email";
    } else if (!exprEmail.test(email)) {
        var error = "Introduzca un email válido";
    } else {
        var error = "";
    }
    correo.setCustomValidity(error);
    return error;
}

function validaDireccion() {
    var direc = document.getElementById("direccion");
    var direccion = direc.value;

    if (direccion.length == 0) {
        var error = "Introduzca su dirección";
    } else {
        var error = "";
    }
    direc.setCustomValidity(error);
    return error;
}

function fortalezaContraseña(password){
    var clave = password;
    var seguridad = 0;
        if (clave.length!=0){
           if (/[0-9]/.test(clave)){
              seguridad += 20;
           }
           if (/[a-z]/.test(clave)){
              seguridad += 10;
           }
           if(/[A_Z]/.test(clave)){
            seguridad += 20;
           }
           if (clave.length >= 4 && clave.length <= 5){
              seguridad += 10;
           }else{
              if (clave.length >= 6 && clave.length <= 8){
                 seguridad += 20;
              }else{
                 if (clave.length > 8){
                    seguridad += 40;
                 }
              }
           }
        }
        return seguridad            
     } 

function validarContraseña(){
    var password = document.getElementById("contraseña");
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
        var error = "Por favor, introduzca un contraseña válida (longitud > 8), incluyendo al menos una letra minúscula, una mayúscula y un digito";
    }else{
        var error = "";
    }
    password.setCustomValidity(error);
    return error;
}

function validarConfirmacion(){
    // Obtenemos el campo de password y su valor
    var password = document.getElementById("contraseña");
    var pwd = password.value;
    // Obtenemos el campo de confirmación de password y su valor
    var passconfirm = document.getElementById("confirmpassword");
    var confirmation = passconfirm.value;

    // Los comparamos
    if (pwd != confirmation) {
        var error = "Confirmación de contraseña incorrecta";
    }else{
        var error = "";
    }

    passconfirm.setCustomValidity(error);

    return error;
}

function colorContraseña(){
    var password = document.getElementById("contraseña");
    var clave = password.value;
    var fortaleza = fortalezaContraseña(clave);
    
    
    if(fortaleza<30){
        var type = "color1";
   }else if(fortaleza >=30 && fortaleza<60){
        var type = "color2";
   }else if(fortaleza>=60 && fortaleza<=90)
        var type = "color3";
   else if(fortaleza > 90 ){
        var type = "color3";
   }else if(validarContraseña()!=""){
    type = "color1";
   }
    password.className = type;
    return type;
}
