function ppbFunction() {
    var x = document.getElementById("ppb-popup-profile-builder").querySelectorAll(".modal-body #user_login");
     var i;
    for (i = 0; i < x.length; i++) {
       // x[i].placeholder = "Custome Placeholder user_login ";
    }
	
	 var y = document.getElementById("ppb-popup-profile-builder").querySelectorAll(".modal-body #user_pass");
     var i;
    for (i = 0; i < x.length; i++) {
       // y[i].placeholder = "Custome Placeholder user_pass";
    }
}





ppb_jquery_last('#ppb_login').css('background-color','#333333f5');
ppb_jquery_last('#ppb_register').css('background-color','#333333f5');
ppb_jquery_last('#ppb_forgot_pass').css('background-color','#333333f5');



	

			
ppb_jquery_last(document).ready(function(){
 setTimeout(function() {
        if(ppb_jquery_last("p").hasClass("wppb-error")){
 ppb_jquery_last('#ppb_login').modal('show');
 
  }
    }, 20);
	
	

});


			
ppb_jquery_last(document).ready(function(){

  if(ppb_jquery_last("p").hasClass("wppb-warning")){
 ppb_jquery_last('#ppb_forgot_pass').modal('show');
  }
});



	
ppb_jquery_last(document).ready(function(){
  if(ppb_jquery_last("p").is("#wppb_general_top_error_message")){
 ppb_jquery_last('#ppb_register').modal('show');
  }
});


	
ppb_jquery_last(document).ready(function(){

  if(ppb_jquery_last("p").is("#wppb_form_success_message")){
 ppb_jquery_last('#ppb_register').modal('show');
  }
});


	
ppb_jquery_last(document).ready(function(){
  if(ppb_jquery_last("p").hasClass("wppb-success")){
 ppb_jquery_last('#ppb_forgot_pass').modal('show');
  }
});

	
	
	
ppb_jquery_last(document).ready(function(){

  if(ppb_jquery_last("li").hasClass("passw1")){
 ppb_jquery_last('#ppb_forgot_pass').modal('show');
  }
});
	
	