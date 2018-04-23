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
            alert("Informe seu CEP!");
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

function find_json_estados(){
    $.ajax({
        url: "/estado/find_json_estados",
        beforeSend: function(){
            $("#endereco_cidade")
                .html("<option>-- Selecione seu estado primeiramente --</option>")
                .attr("readonly", true);
            $("#estados")
                .html("<option>-- Selecione seu Estado --</option>");
        },
        success: function(data){
            $.each(data.estados, function(){
                var estado = this;
                $("#estados")
                    .append("<option value='"+estado.id+"'>"+estado.nome+"</option>");
            });
        },
        error: function(xhr, status, error){
            alert("Erro ao buscar os estados!")
        }
    });
}

$(document).ready(function(){
   find_json_estados();
});