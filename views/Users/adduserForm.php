<section class="wrapper_modules"
    <div class="wrapper_logInSinUp di_ib_ va_top pa-10-10">
		<div class="wrapper_sinup wrapper_form">
			<div class="pa-05-0">
				<span class="op_se la_ co_02_bl_">Alta usuarios</span>
			</div>
                        <?php 
                        $idSession = Session::get("idUser");
                        $users = Users::getById(Session::get("idUser"));
                        
                        $count = count($users);
                             
                        $r = json_encode($users, JSON_FORCE_OBJECT);
                        
                        foreach($users as $items => $dataUser){
                            echo $dataUser."</br>";
                        }
                        
                        //echo $idSession;
                        ?>
			<form name="userForm" action="" class="op_re me_">
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