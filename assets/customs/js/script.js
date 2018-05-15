$("#enviar").click(
        function(){
          $(this).attr("disabled", true);
          $(".result").html("");
          $(".result").hide();

          var nombre = $("#nombre").val();
          if(nombre == '') {
            $("#nombre").addClass("empty");
            $("#nombre").val("campo obligatorio");
            $("#enviar").attr("disabled", false);
            return 0;
          }

          var email = $("#emailContacto").val();
          if(email == '') {
            $("#emailContacto").addClass("empty");
            $("#emailContacto").val("campo obligatorio");
            $("#enviar").attr("disabled", false);
            return 0;
          }
          if(!validarEmail(email)) {
            $("#emailContacto").addClass("empty");
            $("#emailContacto").val("email no válido");
            $("#enviar").attr("disabled", false);
            return 0;
          }

          var phone = $("#phone").val();
          if(phone == '') {
            $("#phone").addClass("empty");
            $("#phone").val("campo obligatorio");
            $("#enviar").attr("disabled", false);
            return 0;
          }

          var message = $("#message").val();

          $.ajax( {
            method: "POST",
            url: "includes/sendemail.php",
            data: { nombre: nombre, email: email, phone: phone, message: message },
            dataType: "json"
          })
          .done(function( result ) {
            if(result.status == "ok") {
              $(".result").removeClass("alert-danger");
              $(".result").addClass("alert-success");
              $(".result").show();
            } else {
              $(".result").removeClass("alert-success");
              $(".result").addClass("alert-danger");
              $(".result").show();
              $("#enviar").attr("disabled", false);
            }
            $(".result").html(result.msg);
            
          });
        }
        );

      $(".form input").click(function(){
        if($(this).hasClass("empty")) {
          $(this).val("");
          $(this).removeClass("empty"); 
        }
      });

      function validarEmail(value) {
        emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        return emailRegex.test(value);
      }