$(document).ready(function () {
    
    $.removeAllStorages();
    
    $("#enterMobilebuttom").click(function (){
        console.log("Botão entrar. E criar um sessao");
        var storage = $.cookieStorage;
        var data = {
            'user_id':'73',
            'user_name':'Leandro Lisura'
        };
        storage.set(data);
        
        if(storage.isSet(['user_id'])){
            console.log("logado");
            window.location.href = "class_list.html";
        }else{
            console.log("Não logado");
        }
        
        
    });
    
});
