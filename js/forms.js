$(document).ready(function(){
    
    sacarBordes();
    
    var cotizacion = $("#cotizacionBtn");
    var folleto = $("#folletoBtn");
    
    //var form_cot = $("#cotizacion-form");
    //var form_fol = $("#folleto-form");
    //var contactForm = $("#contact-form");
    
    function resetForm(){
        $(".input").each(function(){
            $(this).val("");
        });
    }
    
    function sacarBordes(){
        $(".input").each(function(){
            $(this).css("border", "0");
        });
    }
    function validar(){
        /*$(".input", form).each(function(){
            var elem = $(this);
            if( elem.val() == '' ){
                return elem.attr("class");
            }
        });***/
        if($("#nombre").val() == ''){
            return  "#nombre";
        }
        if($("#apellido").val() == ''){
            return "#apellido";
        }
        if($("#email").val() == ''){
            return "#email";
        }
        if($("#fono").val() == ''){
            return "#fono";
        }
        if($("#comentario").val() == ''){
            return "#comentario";
        }
        return 1;
    }
    
    $(".btn").click(function(){
        sacarBordes();
        var valor = validar();
        if ( valor != 1){
            $(valor).css("border","3px solid red");
            alert("Todos los campos son obligatorios");
            /*$("#msg").fadeIn(1000, function(){
                setTimeout("$('#msg').fadeOut(1000)",10000);
            });*/
        }else{
            //form.submit();
            var nombre = $("#nombre").val();
            var apellido = $("#apellido").val();
            var email = $("#email").val();
            var fono = $("#fono").val();
            var comentario = $("#comentario").val();
            var formulario = $("#form").val();
            
            $.post('forms.php',{
                'nombre'     : nombre,
                'apellido'   : apellido,
                'email'      : email,
                'fono'      : fono,
                'comentario' : comentario,
                'formulario' : formulario},
                function(data){
                    if(data == 1){
                        /*$("#msg").removeClass("error");
                        $("#msg").addClass("success");
                        $("#msg").html("Nos contactaremos con usted");
                        $("#msg").fadeIn(1000, function(){*/
                        //setTimeout("$(location).attr('href','.')",2000);
                        alert("Sus datos se han enviado correctamente");
                        resetForm();
                        //});
                    }else{
                        alert("Lo sentimos, no es posible gestionar su solicitud. Intente mas tarde.");
                    }
            })
        }
        
    });
});
