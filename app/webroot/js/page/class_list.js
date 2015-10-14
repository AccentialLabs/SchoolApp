$(document).ready(function () {
    var storage = $.cookieStorage;
    
    if(storage.isSet(['user_id'])){
        console.log("logado");
        var user_object = storage.get(['user_name']);
        console.log(user_object.user_name);
    }else{
        console.log("Não logado");
    }
        
        
    
});
