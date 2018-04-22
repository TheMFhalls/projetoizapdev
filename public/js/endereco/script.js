function find_by_cep(cep){
    $.ajax({
        url: "/endereco/find_by_cep/"+cep,
        beforeSend: function(){
          $("form input, form textarea")
              .val("Carregando...");
        },
        success: function(data){

        },
        error: function(xhr, status, error){

        },
        complete: function(){
            $("input[type='text'], textarea").each(function(){
                var $el = $(this);
                if($el.val() == "Carregando...")
                    $el.val("");
            });
        }
    });
}