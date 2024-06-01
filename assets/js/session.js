$(document).ready(async function(){

	//CAMPOS DEL FORMULARIO
	const loginCedula = $("#loginCedula");

    $(document).on('click', '#loginSend', () =>{

        $.ajax({
            url: "",
            method: 'POST',
            data: {existeUsuarios: 1, ajax: 1},
            success: function(r){
                
            },
            dataType: 'JSON',
        })
    });
});