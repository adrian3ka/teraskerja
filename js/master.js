
$(document).ready(function() {
	
	$(window).scroll(function(event){
		if($(this).scrollTop() > 1){
			$('header').addClass('shrink');
			$('#navBar').addClass('shrink');
			$('#navButton').addClass('shrink');
		}
		else{
			$('header').removeClass('shrink');
			$('#navBar').removeClass('shrink');
			$('#navButton').removeClass('shrink');
		}
	});
	$(".buttonToTop").click(function () {
	   //1 second of animation time
	   //html works for FFX but not Chrome
	   //body works for Chrome but not FFX
	   //This strange selector seems to work universally
	   $("html, body").animate({scrollTop: 0}, 400);
	});
	$(".buttonToRegistration").click(function () {
		$('html, body').animate({
			scrollTop: $("#registrationContainer").offset().top- 110 
		}, 1000);
	});
	function scrollWin() {
		window.scrollTo(1000, 1000);
	}
	$(".banner1").click(function(){
		//document.getElementById("occupation").innerHTML = "CLIENT";
		$("#occupation").val("Client");
	});
	$(".banner2").click(function(){
		//document.getElementById("occupation").innerHTML = "LANCER";
		$("#occupation").val("Lancer");
	});
	$(".banner1Mobile").click(function(){
		//document.getElementById("occupation").innerHTML = "CLIENT";
		$("#occupation").val("Client");
	});
	$(".banner2Mobile").click(function(){
		//document.getElementById("occupation").innerHTML = "LANCER";
		$("#occupation").val("Lancer");
	});
	$("#navButton").click(function () {
	   //1 second of animation time
	   //html works for FFX but not Chrome
	   //body works for Chrome but not FFX
	   //This strange selector seems to work universally
		if(document.getElementById("navButton").innerText == ">>"){
			//$('#wrapper').addClass('slideRight');
			$('#navBar').addClass('slideRight');
			$("#navButton").addClass('clicked');
			document.getElementById("navButton").innerHTML = "<<";
		}
		else{
			//$('#wrapper').removeClass('slideRight');
			$('#navBar').removeClass('slideRight');
			$("#navButton").removeClass('clicked');
			document.getElementById("navButton").innerHTML = ">>";
		}
	});
	
	
	
	
	//initial
	//getNotifications();
});