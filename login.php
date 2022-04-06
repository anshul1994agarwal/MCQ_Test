<?php
	require_once('links.php');
?>
<p id = "loader" ><img src = "images/Spinner-5.gif"/></p>

<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card mt-100">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="images/user.jpg" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" id = "username" class="form-control input_user" value="" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="pass" id = "pass" class="form-control input_pass" value="" placeholder="password">
						</div>
						
						<div class="d-flex justify-content-center mt-3 login_container">
				 	        <button type="button" name="button" onclick = "doLogin()" class="btn login_btn">Login</button>
				        </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="signup.php" class="ml-2">Sign Up</a>
					</div>
					
				</div>
				<span id = "error" class = "errormessage hide"></span>
			</div>
		</div>
	</div>

	<script>

	function doLogin(){
		var username=$("#username").val();
 		var pass=$("#pass").val();

		if(username ==""){

			$("#error").show();
			$("#error").text("Please enter username")

		}else if(pass == ""){
			$("#error").show();
			$("#error").text("Please enter Password")

		}else{
			$("#loader").css({"display":"block"});
			$("#error").hide();
			$.ajax
				({
					type:'post',
					url:'user_ajax/login_ajax.php',
					data:{
						username:username,
						password:pass
					},
					success:function(response) {
						console.log(response);
						if(response=="Success")
						{
							$("#loader").css({"display":"none"});
							window.location.href="exam.php";
						}else if(response=="Admin"){
							$("#loader").css({"display":"none"});
							window.location.href="adminDashboard.php";
						}
						else{

							$("#loader").css({"display":"none"});
							$("#error").show();
							$("#error").text("Username and Password not match")

						}
					}	
				});
		}
	}

</script>