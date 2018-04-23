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
                .html("<option value='0'>-- Selecione seu Estado --</option>");
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

function find_json_cidades($el){
    var cidades = $("#endereco_cidade");
    $.ajax({
        url: "/cidade/find_json_cidades/"+$el.val(),
        beforeSend: function(){
            cidades
                .html("<option>Carregando...</option>")
                .attr("readonly", true);
        },
        success: function(data){
            if(data.cidades){
                cidades.html("");
                $.each(data.cidades, function(){
                    var cidade = this;
                    cidades
                        .append("<option value='"+cidade.id+"'>"+cidade.nome+"</option>");
                });
                cidades.attr("readonly", false)
            }else{
                cidades
                    .html("<option>-- Sem cidades para este estado --</option>")
                    .attr("readonly", true);
            }
        },
        error: function(xhr, status, error){
            alert("Erro ao buscar as cidades!")
        }
    });
}

$(document).ready(function(){
   find_json_estados();
});