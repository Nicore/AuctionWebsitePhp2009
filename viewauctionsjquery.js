// JavaScript Document
$(document).ready(function(){
	
   $("img").hover(function(){	
	 var offset = $(this).offset();
	 $("#popup").load('TCshowdesc_script.php?Item=' + this.id).show().css("top",offset.top-50);
	},
	function(){
		$("#popup").hide();	
	});
 });


	   
	   
