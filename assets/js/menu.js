$(function(){

	$(".menu-item").on("click", ".menu-item-inner", function(e){

		window.location = base_url + $(this).find("a").attr("href");

		return false;
	});

	$(".step-swapper").on("click", function(){
		
		step = $(this).data("step");

		$(".step").each(function(){
			if($(this).data("step") == step)
			{
				$(this).show();
			}
			else
			{
				$(this).hide();
			}
		});

		return false;
	});

});