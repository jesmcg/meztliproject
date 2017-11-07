<section class="section-sinin flex_ flex-container-row-wrap">
	<div class="wrapper_description_pos di_ib_ va_top pa-10-10">
	</div>
	<div class="wrapper_logInSinUp di_ib_ va_top pa-10-10">
		<div class="wrapper_login wrapper_form">
			<div class="pa-05-0">
				<span class="op_se la_ co_02_bl_">Iniciar Sesion</span>
			</div>
			<form name="loginForm" action="" class="op_re me_">
				<div class="group_items ">
					<label for="email_login">Email</label>
					<input id="email_login" class="txt_input_default" name="email" type="text" placeholder="email@dominito.com">
				</div>
				<div class="group_item">
					<label for="password_login">Contrasena</label>
					<input id="password_login" class="txt_input_default" name="password" type="password" placeholder="********">
				</div>
				<div class="group_items">
					<input type="submit" class="btn_ btn_primary" value="Ingresar">
				</div>
			</form>
		</div>
		<div class="wrapper_sinup wrapper_form">
			<div class="pa-05-0">
				<span class="op_se la_ co_02_bl_">Registrarse</span>
			</div>
			<form name="sinupForm" action="" class="op_re me_">
				<div class="group_items">
					<label for="name_sinup">Name</label>
					<input id="name_sinup" class="control_form" name="username" type="text" placeholder="Name(s)">
				</div>
				<div class="group_items">
					<label for="lastname_sinup">Lastname</label>
					<input id="lastname_sinup" class="control_form" name="lastname" type="text" placeholder="Lastname">
				</div>
				<div class="group_items">
					<label for="mothersname_sinup">Mothers name</label>
					<input id="mothersname_sinup" class="control_form" name="mothersname" type="text" placeholder="Mothersname">
				</div>
				<div class="group_items">
					<label for="email_sinup">Email</label>
					<input id="email_sinup" class="control_form" name="email" type="text" placeholder="email@dominito.com">
				</div>
				<div class="group_items">
					<label for="password_sinup">Contrasena</label>
					<input id="password_sinup" class="control_form" name="password" type="password" placeholder="********">
				</div>
				<div class="group_items">
					<label for="passwordr_sinup">Contrasena</label>
					<input id="passwordr_sinup" class="control_form" name="passwordr" type="password" placeholder="********">
				</div>
				<div class="group_items">
					<input type="submit" class="btn_ btn_primary" value="Registrarse">
				</div>
			</form>
		</div>
	</div>
</section>
<script>
	$(".wrapper_form form input").on("blur keyup keydow", function(e){
		var ReadyToSend = false;

		var form = $(this).parent().parent()[0];
		var formName = $(this).parent().parent().attr("name");

		switch(formName){
			case "loginForm":
				console.log("logica del login");
				ready = true;
			break;
			case "sinupForm":
				var name = $(form.querySelector("[name=username]"));
				var lastname = $(form.querySelector("[name=lastname]"));
				var email = $(form.querySelector("[name=email]"));
				var pass = $(form.querySelector("[name=password]"));
				var passr = $(form.querySelector("[name=passwordr]"));

				if(name.val() != ""){
					name.removeClass("wrong").addClass("rigth");
					ReadyToSend = true;
				}else{
					name.removeClass("rigth").addClass("wrong");
				}
				if(lastname.val() != ""){
					lastname.removeClass("wrong").addClass("rigth");
					readyToSend = true;
				}else{
					lastname.removeClass("rigth").addClass("wrong");
				}
				if(e.type == "blur"){
					validateUnic(email,"Users","ValidateEmail");
				}
				if(pass.val() != "" || passr.val() != ""){
					if(pass.val() == passr.val()){
						pass.removeClass("wrong").addClass("rigth");
						passr.removeClass("wrong").addClass("rigth");
						readyToSend = true;
					}else{
						pass.removeClass("rigth").addClass("wrong");
						passr.removeClass("rigth").addClass("wrong");
						
						readyToSend = false;
					}
				}
			break;
			default:
			break;
		}

	});


	$(".wrapper_form form").submit(function(e){
		e.preventDefault();

		var form = $(this)[0];
		var formName = $(this).attr("name");
		var data = {};

		var inputs = form.querySelectorAll("input");
		
		$(inputs).each(function(){
			var input = $(this);
			if($(input).hasClass("wrong")){
				readyToSend = false;
			}
		});
		
		if(formName == "loginForm"){
			readyToSend = true;
		}
		if(readyToSend){				
			var data = processForm(form);	
			console.log(data);

			switch(formName){
				case "loginForm":
					$.ajax({
						url:"<?php print(URL);?>users/login/",
						type: "POST",
						data: data,
						success: function(result){
							
							if(JSON.parse(result)){
								var r = JSON.parse(result);
								if(r.error == 0){
									location.reload();
								}else{
									error;
								}
							}
							
					
							
							
						},error(xhr, status){}
					});
				break;
				case "sinupForm":
					$.ajax({url: "<?php print(URL)?>users/register/",
							data: data,
							type: "POST",
							success: function(result){
								var obJSON = JSON.parse(result);
								if (obJSON.error == 0){
									location.reload();
								}else{
									console.log(obJSON.msg);
								}
							},error(xhr, status){
								console.log("Error al enviar los datos");
							}
					});
				break;
			}
		}
		return false;
	});

	function validateUnic(who,controler,method){
		if(who.val() != ""){
			$.ajax({url: "<?php print(URL)?>"+controler+"/"+method+"/"+who.val(),
					type: "GET",
					success: function (result){
						var r = result;
						if (r != 0){
							who.removeClass("rigth").addClass("wrong");
							ReadyToSend = false;
						}else{
							who.removeClass("wrong").addClass("rigth");
							ReadyToSend = true;
						}
					},error: function(xhr, status){
						console.log(xhr+" , "+status);
					}

				});
		}else{
			who.removeClass("rigth").addClass("wrong");
		}
	}

	function processForm(form){
		var inputs = form.querySelectorAll("input");
		var data = {};
		$(inputs).each(function(){
			var input = $(this);
			if(input.attr("type") != "submit"){
				var attrname = input.attr("name");
				data[attrname] = input.val();
			}
		});
		return data;
	}
</script>