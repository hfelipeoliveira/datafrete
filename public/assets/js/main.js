(function(win, doc){
    'use strict';

    function confirmaDelete(event){
        event.preventDefault();
        //console.log(event.target.parentNode.href);
        let token = doc.getElementsByName("_token")[0].value;
        if(confirm("Deseja deletar o registro?")){
            console.log(token);
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
    if(doc.querySelector('.js-del')){
        let btn = doc.querySelectorAll('.js-del');
        for(let i = 0; i < btn.length; i++){
            btn[i].addEventListener('click',confirmaDelete,false);
        }
    }

    function validaCep(elemento, feedback, segundoFeedback){
        if(elemento.value.length === 9){
            var cep = elemento.value.replace(/([^\d])+/gim, '')
            var URL = '/api/validacao-cep/'+cep;
            fetch(`${URL}`)
            .then((body) => body.json())
            .then((data) => {
                if(data.validade){
                    feedback.innerHTML = "CEP válido";
                    //  Se ambos os inputs forem válidos, habilita o botão de enviar
                    if(segundoFeedback.innerHTML.substr(0, 10) == "CEP válido"){   
                        btnEnviar.disabled = false;
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

    var cepOrigem = doc.getElementById("cep_origem");
    var cepDestino = doc.getElementById("cep_destino");
    var cepOrigemFeedback = doc.getElementById("feedback-cep-origem");
    var cepDestinoFeedback = doc.getElementById("feedback-cep-destino"); 
    var btnEnviar = doc.getElementById("btn-enviar"); 

    if(cepOrigem){
        btnEnviar.disabled = true;
        //  Analisa as alterações nos input
        cep_origem.onkeyup = function(e){
            validaCep(cepOrigem, cepOrigemFeedback, cepDestinoFeedback);
        }
        cep_destino.onkeyup = function(e){
            validaCep(cepDestino, cepDestinoFeedback, cepOrigemFeedback);
        }
    }
    



})(window, document);