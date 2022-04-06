<!DOCTYPE html>
<html lang="en">
<head>
  <title>MOODLE Test</title>

  <?php
    session_start();
    if(isset($_SESSION["userIDTesting"])){
  
      $name = $_SESSION["name"];
      
  
    }else{
      header("Location: index.php"); 
    }

    require_once('links.php');
  ?>
  
</head>
<body>

  <?php
      require_once('header.php');
  ?>
    <p id = "loader" ><img src = "images/Spinner-5.gif"/></p>
    <p>
        Welcome, <span> <?php echo $name;?> </span>
    </p>

    <div class="container">
    <h1>Multiple Choice Questions Answers</h1>
    
    <form>
        <div id = "accordion">
        </div>
        <h1 class = "errormessage hide" id = "error">  </h1>
        <button onclick = "getResult()" type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
        
    </form>
</div>


    
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
				<p>Your have score <span id = "marks"></span>.</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href = "exam.php" type="button" class="btn btn-success" data-dismiss="modal">Close</a>
        </div>
        
      </div>
    </div>
  </div>
  <?php
      require_once('footer.php');
  ?>
</body>
</html>
<script>

$(document).ready(function(){
    $.ajax({ url: "https://opentdb.com/api.php?amount=10",
        context: document.body,
        success: function(response){
            

            var mcqdetails = response.results
            var count = 1;
            mcqdetails.forEach(function (item, index) {
                
                if(item.incorrect_answers.length <2){
                    $("#accordion").append(
                '<h3>Q'+ count +' '+ item.question +' </h3>'+
                    '<div class="form-group">'+ 
                        '<ol>'+
                            '<li>'+
                                '<input type="radio" name="q'+ index +'" value="'+ item.correct_answer +'" />'+ item.correct_answer +''+
                            '</li>'+
                            '<li>'+
                                '<input type="radio" name="q'+ index +'" value="'+ item.incorrect_answers[0] +'" />'+ item.incorrect_answers[0] +''+
                            '</li>'+
                            
                        '</ol>'+
                        '<input type = "hidden" id = "correct'+ index +'" name = "correct'+ index +'" value = "'+ item.correct_answer +'">'+
                    '</div>'+
                    '<br/>'

            
            );
                }else{
                    $("#accordion").append(
                '<h3>Q'+ count +' '+ item.question +' </h3>'+
                    '<div class="form-group">'+ 
                        '<ol>'+
                            '<li>'+
                                '<input type="radio" name="q'+ index +'" value="'+ item.correct_answer +'" />'+ item.correct_answer +''+
                            '</li>'+
                            '<li>'+
                                '<input type="radio" name="q'+ index +'" value="'+ item.incorrect_answers[0] +'" />'+ item.incorrect_answers[0] +''+
                            '</li>'+
                            '<li>'+
                                '<input type="radio" name="q'+ index +'" value="'+ item.incorrect_answers[1] +'" />'+ item.incorrect_answers[1] +''+
                            '</li>'+
                            '<li>'+
                                '<input type="radio" name="q'+ index +'" value="'+ item.incorrect_answers[2] +'" />'+ item.incorrect_answers[2] +''+
                            '</li>'+
                        '</ol>'+
                        '<input type = "hidden" name = "correct'+ index +'" id = "correct'+ index +'" value = "'+ item.correct_answer +'">'+
                    '</div>'+
                    '<br/>'

            
            );
                }
                count ++;
            
        });

        }
    });
});


function getResult() {
    $("#loader").css({"display":"block"});
    var n = 10;
    var error = "";
    for (let i = 0; i < n; i++) {
        if (!$("input[name='q"+i+"']:checked").val()) {
            error = "Please filled all question";
            break;   
        }    
    }

    if(error != ""){
        $("#error").show();
		$("#error").text(error)

    }
    else{
        $("#loader").css({"display":"block"});
        $("#error").hide();

        var result = 0;

        for (let i = 0; i < n; i++) {
            var ans = $("input[name='q"+i+"']:checked").val()
            var correctans =$("#correct"+i+"").val();
            if(ans == correctans){
                result = result + 1;
            }

        }

        var user_id = <?php echo json_encode($_SESSION['userIDTesting']) ?>;
        
        $.ajax
				({
					type:'post',
					url:'user_ajax/result_ajax.php',
					data:{
						
						id:user_id,
						result:result
					},
					success:function(response) {
						console.log(response);
						if(response=="1")
						{
							$("#loader").css({"display":"none"});
                            $("#marks").text(result)
							// $('#myModal').modal('show');
							$("#myModal").show();
							// window.location.href="index.php";
						}
						else{

							$("#loader").css({"display":"none"});
							// $("#successModal").show();
							alert("Something went wrong try after sometime");

						}
					}	
				});

        console.log(result);
    }


    
    
}


</script>