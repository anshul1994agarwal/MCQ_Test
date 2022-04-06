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
							<input type="text" name="username" id="username" class="form-control input_user" value="" placeholder="username">
						</div>
                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="email" name="email" id = "email" class="form-control input_user" value="" placeholder="enter email">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="pass" id = "pass" class="form-control input_pass" value="" placeholder="password">
						</div>

                        <div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="cpass" id = "cpass" class="form-control input_pass" value="" placeholder="confirm password">
						</div>
						
						<div class="d-flex justify-content-center mt-3 login_container">
				 	        <button type="button" name="button" class="btn login_btn" onclick = "doSignup()">Sign Up</button>
				        </div>
						<span id = "error" class = "errormessage hide"></span>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links signinurl">
						Already have an account? <a href="index.php" class="ml-2">Sign In</a>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
	


	<!-- Success Modal -->

<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Success Message</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
				<h4>Great!</h4>	
				<p>Your account has been created successfully.</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href = "index.php" type="button" class="btn btn-success" data-dismiss="modal">Sign In</a>
        </div>
        
      </div>
    </div>
  </div>

<script>

	function doSignup(){
		var email=$("#email").val();
 		var pass=$("#pass").val();

		var username=$("#username").val();
 		var cpass=$("#cpass").val();

		if(username ==""){

			$("#error").show();
			$("#error").text("Please enter username")

		}else if(email == ""){
			$("#error").show();
			$("#error").text("Please enter email")

		}else if(pass == ""){
			$("#error").show();
			$("#error").text("Please enter Password")

		}else if(cpass == ""){
			$("#error").show();
			$("#error").text("Please enter confirm password")

		}else if(pass != cpass){
			console.log(pass + "  " + cpass)
			$("#error").show();
			$("#error").text("password and confirm password not match")

		}else{
			$("#loader").css({"display":"block"});
			$("#error").hide();
			$.ajax
				({
					type:'post',
					url:'user_ajax/signup_ajax.php',
					data:{
						username:username,
						email:email,
						password:pass
					},
					success:function(response) {
						console.log(response);
						if(response=="1")
						{
							$("#loader").css({"display":"none"});
							// $('#myModal').modal('show');
							$("#myModal").show();
							// window.location.href="index.php";
						}
						else if(response=="exist")
						{
							$("#error").show();
							$("#error").text("User and Email exist")
						}else{

							$("#loader").css({"display":"none"});
							// $("#successModal").show();
							alert("Wrong Details");

						}
					}	
				});
		}
	}

</script>