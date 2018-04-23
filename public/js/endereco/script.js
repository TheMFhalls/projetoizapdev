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
                $.each(data, function(index){
                    $("input[name='endereco["+index+"]'], "+
                    "textarea[name='endereco["+index+"]']")
                        .val(String(this));
                });
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