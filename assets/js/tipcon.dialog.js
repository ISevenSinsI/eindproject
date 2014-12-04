$(function(){

	$("body").on("click", ".dialog-close", function(){
		$dialog = $(this).closest(".dialog");

		$dialog.hide();
	});

	$("body").on("click", ".dialog", function(e){
		if($(e.target).hasClass("dialog")){
			close_dialog();
		}
	});

	$("body").on("keyup", function(e){
		if(e.keyCode == 27)
		{
			close_dialog();
		}
	});

});

function position_dialog()
{
	body_height = $(window).height();

	div_height = $(".dialog .dialog-inner").height(); 

	position = (body_height / 2) - (div_height / 2);

	$(".dialog .dialog-inner").css("margin-top", position);

}

function close_dialog()
{
	$(".dialog").hide();
}

function activate_client_label_dialog(client_id)
{
	$(".print-invoice-label").data("client-id", client_id);
	$(".print-shipping-label").data("client-id", client_id);
	$(".print-visit-label").data("client-id", client_id);
	position_dialog();
	$(".client_label_dialog").show();
}
