<?php require MODULE."header.php";?>
<body>
    <header class="header-sinin  ce_">
        <h1>Generic POS</h1>
	<p>Punto de venta para tu negocio.</p>
	<ul id="userMenu" class="wrapper_logut di_bl_">
			<?php 
            	if(Session::get("username")){
                	echo "<span class='logout di_ib_ va_top op_se me_ pa-05-10'>".Session::get("username")."</span>";
                	echo "<span class='logout cu_po_ di_ib_ va_top op_se me_ pa-05-10'>Logout</span>";
            	}else{
            		echo "";
                	
            	}
            ?>
		
    </ul>
    </header>
    <div class = "wrapper_content">
        <?php 
            if(Session::get("username")){
                require MODULE."menu.php";
                $this->usrCtrlr->createUser();
            }else{
                $this->usrCtrlr->loginSinup();
            }
        ?>
    </div>
    <script>
	$("#userMenu span").click(function(){
		var opt = $(this).text();
			switch(opt){
				case "Logout":
					$.ajax({url: "<?php print(URL);?>users/logout/>",
							type: "GET",
							success: function(){
								location.reload();
						}});
				break;
			}
			
		}
	);
	</script>
</body>
</html>
