$(document).ready(function(){
show=false
$("#sign").click(function(){
		if (!show)
		{
			$(".signup").show("slow");
			show=true;
		}
		else
		{
			$(".signup").hide("slow");	
			show=false;
		}
		
	});
});