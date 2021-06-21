(function(win, doc){
    'use strict';

    //  Exibe caixa de confirmação, se usuário confirmar ele deleta e redireciona
    function confirmaDelete(event){
        event.preventDefault();
        let token = doc.getElementsByName("_token")[0].value;
        
        if(confirm("Deseja deletar o registro?")){
            let ajax = new XMLHttpRequest();
            ajax.open("DELETE", event.target.parentNode.href);
            ajax.setRequestHeader('X-CSRF-TOKEN',token);
            ajax.onreadystatechange = function(){

                if(ajax.readyState === 4 && ajax.status === 200){
                    win.location.href = "datafrete";
                }

            }
            ajax.send();
        }else{
            return false;
        }

    }

    //  Habilita um listener para cada botão de deletar
    if(doc.querySelector('.js-del')){
        let btn = doc.querySelectorAll('.js-del');
        for(let i = 0; i < btn.length; i++){
            btn[i].addEventListener('click',confirmaDelete,false);
        }
    }

    //  Valida os CEPs, exibe os feedbacks, exibe o distância no input
    function validaCep(elemento, feedback, segundoElemento, segundoFeedback, divCoordenadasCepOrigem, coordenadasCepDestino, inputDistancia){

        if(elemento.value.length === 9){
            var cep = elemento.value.replace(/([^\d])+/gim, '');
            var cep2 = segundoElemento.value.replace(/([^\d])+/gim, '');            
            var URLValidaCep = '/api/validacao-cep/'+cep;
            var URLCalculaDistancia = '/api/coordenadas-cep/'+cep+'/'+cep2+'/';
            fetch(`${URLValidaCep}`)
            .then((body) => body.json())
            .then((data) => {
                if(data.validade){
                    feedback.innerHTML = "CEP válido";
                    if(segundoFeedback.innerHTML.substr(0, 10) == "CEP válido"){   
                        //  Busca as geolocalização e calcula a distância
                        fetch(`${URLCalculaDistancia}`)
                        .then((body) => body.json())
                        .then((data) => {
                            divCoordenadasCepOrigem.innerHTML = "Latitude: " + data.cepOrigem.lat + " / Longitude: " + data.cepOrigem.lon;
                            coordenadasCepDestino.innerHTML = "Latitude: " + data.cepDestino.lat + " / Longitude: " + data.cepDestino.lon;
                            inputDistancia.value = data.distancia;
                            //  Se tudo estiver validado, botão input é habilitado
                            btnEnviar.disabled = false;
                        })
                        .catch((error) => console.error('Erro:', error.message || error))
                    }
                }else{
                    feedback.innerHTML = "CEP inválido";
                    btnEnviar.disabled = true;
                }
            })
            .catch((error) => console.error('Erro:', error.message || error))
        }else{
            feedback.innerHTML = "CEP inválido";
            btnEnviar.disabled = true;
        }
        
    }

    var inputCepOrigem = doc.getElementById("cep_origem");
    var inputCepDestino = doc.getElementById("cep_destino");
    var divCepOrigemFeedback = doc.getElementById("feedback-cep-origem");
    var divCepDestinoFeedback = doc.getElementById("feedback-cep-destino");
    var divCoordenadasCepOrigem = doc.getElementById("coordenadas-cep-origem");
    var divCoordenadasCepDestino = doc.getElementById("coordenadas-cep-destino");  
    var inputDistancia = doc.getElementById("distancia"); 
    var btnEnviar = doc.getElementById("btn-enviar"); 

    if(inputCepOrigem){
        btnEnviar.disabled = true;
        //  Analisa as alterações nos input
        cep_origem.onkeyup = function(e){
            validaCep(inputCepOrigem, divCepOrigemFeedback, inputCepDestino, divCepDestinoFeedback, divCoordenadasCepOrigem, divCoordenadasCepDestino, inputDistancia);
        }
        cep_destino.onkeyup = function(e){
            validaCep(inputCepDestino, divCepDestinoFeedback, inputCepOrigem, divCepOrigemFeedback, divCoordenadasCepOrigem, divCoordenadasCepDestino, inputDistancia);
        }
    }
    

})(window, document);