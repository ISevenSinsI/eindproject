<div class="dialog user_delete_dialog">
	<div class="dialog-inner">
		<div class="dialog-title">
			<div class="title">
				Gebruiker verwijderen
			</div>
			<div class="dialog-close">
				<i class="fa fa-times-circle"></i>
			</div>
		</div>
		<div class="dialog-content">
			<form class="pure-form pure-form-aligned user-delete-form" method="post" action="#">
				<div class="pure-control-group" style="text-align: center;">
                    <p>Weet u zeker dat u de gebruiker <i class="title"></i> wilt verwijderen?</p>
                </div>

                 <div class="pure-control-group dialog_control">
                	<input type="hidden" name="deleted_id" value="0" />
	               	<div class="pure-button pure-button-primary pure-button dialog-submit">Ja</div>
	               	<div class="pure-button pure-button-primary pure-button dialog-close">Nee</div>
               	</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(function(){

		$(".dialog-submit").on("click", function(){
			id = $("input[name='deleted_id']").val();

			$.post('../functions/users.php',{
				action: 'delete_user',
				id: id,
			},function(data){
				window.location = window.location;
			});

			return false;

		});
		$(".dialog-close").on("submit", function(){
			 $(".user_delete_dialog").hide();
			return false;
		});
	});
</script>