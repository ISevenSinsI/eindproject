<div class="pure-g">
	<div class="pure-u-1">
		<table class="pure-table pure-table-bordered pure-table-striped" id="datatable">
		    <thead>
	    	  	<tr class="pure-form">
					<th><input data-column="0" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="#" /></th>
					<th><input data-column="1" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Naam" /></th>
					<th><input data-column="2" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Inlogcode" /></th>
					<th><input data-column="3" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Rol" /></th>
					<th><input data-column="4" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Tel-nr" /></th>
					<th><input data-column="5" class="datatable-filter" type="text" class="table-filter" name="search[]" placeholder="Woonplaats" /></th>
					<th></th>
				</tr>
		        <tr>
		            <th class="column-id">#</th>
		            <th>Naam</th>
		            <th>E-mail</th>
		            <th>Rol</th>
		            <th>Tel-nr</th>
		            <th>Woonplaats</th>
		            <th></th>
		        </tr>
		      
		    </thead>
		    <tbody>
		    	<?php foreach($users as $user): ?>
			    <tr data-id="<?=$user["id"]?>">
			      <td><?= $user["id"] ?></td>
			      <td><?= $user["name"] ?></td>
			      <td><?= $user["email"] ?></td>
			      <td><?= $user["role"] ?></td>
			      <td><?= $user["phone"] ?></td>
			      <td><?= $user["city"] ?></td>
			      <td class="useractions">
			        <a href="users/details/<?=$user["id"]?>" class="pure-button pure-button-primary pure-button-small but_user_index" title="Details">
			          <i class="fa fa-info-circle"></i>
			        </a>
			        <?php if(is_authorized("users::edit")): ?>
			          <a href="users/edit/<?=$user["id"]?>" class="pure-button pure-button-primary pure-button-small but_user_index" title="Bewerken">
			            <i class="fa fa-pencil"></i>
			          </a>
			        <?php endif; ?>
			        <?php if(is_authorized("users::delete")): ?>
					<a href="#" class="pure-button pure-button-primary pure-button-small but_user_index button-delete-user delete_button" data-id="<?=$user['id'] ?>" data-name="<?= $user['name'] ?>" title="Verwijderen">						<i class="fa fa-trash-o"></i>
					</a>
				<?php endif; ?>
			      </td>
			    </tr>
				<?php endforeach; ?>
		    </tbody>
		    <tfoot>
		    </tfoot>
			    <?php if(is_authorized("users::add")): ?>
					<a href="users/add" class="pure-button pure-button-primary float_right" title="Toevoegen">
						<i class="fa fa-plus-circle"></i>
					</a>
				<?php endif; ?>
		</table>
	</div>
</div>
<style>
  #datatable tbody tr {
    cursor: pointer;
  }
</style>

<script>
  $(function(){
    create_datatable();

    $("#datatable").on("click", ".button-delete-user", function(){
    	$("input[name='user_id']").val($(this).data("id"));

       $(".user_delete_dialog i.title").html($(this).data("name"));

        $(".user_delete_dialog").show();

        return false;

    });

    $("#datatable").on("click", "tbody tr", function(){

    	window.location = "users/details/" + $(this).data("id");

    });
    
  });
</script>

<?= $this->load->view("users/delete_user_dialog"); ?>