function find_by_cep(cep){
    $.ajax({
        url: "/endereco/find_by_cep/"+cep,
        beforeSend: function(){
          $("form input[type='text'], form textarea")
              .val("Carregando...");
        },
        success: function(data){
            if(data.erro){
                alert("Informe um CEP válido!");
            }else{

            }
        },
        error: function(xhr, status, error){
            alert("Informe seu CEP");
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