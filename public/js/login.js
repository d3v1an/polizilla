$(function() {

	// Boton de inicio de session
	$(".btn-login").click(function(e){

		var user = $("#user","#login-box").val();
		var pass = $("#pass","#login-box").val();
		var reme = $('#remember_me',"#login-box").is(':checked') ? 'on' : 'off';

		if(user=='' || pass=='') {
			alert('El usuario o password son invalidos');
			return false;
		}

		$.d3POST(base_path+'/login',{username:user,password:pass,remember:reme},function(data){

			if(data.status==true) {
				window.location.href = base_path+'/analytic'
			} else {
				alert('Usuario y/o contraseña incorrectos');
				return false;
			}

		});

		e.preventDefault();
	});

});