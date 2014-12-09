function create_datatable()
{
	var oTable = $('#datatable').dataTable({
		"bInfo": false,
		"bFilter": true,
		"bLengthChange": false,
		"bStateSave": false,
		"bPaginate": true,
		"iDisplayLength": 20,
		"oLanguage": get_translations(),
		"fnDrawCallback": function(oSettings, json) {
			style_buttons();
	    }
	});


	$(".datatable-filter").on("keyup", function () {
		oTable.fnFilter( $(this).val(), $(this).data("column") );
	});

	$(".datatable-filter").on("change", function () {
		oTable.fnFilter( $(this).val(), $(this).data("column") );
	});

	// $(".datatable-filter").each(function(){
	// 	$(this).trigger("keyup");
	// 	$(this).trigger("change");
	// });

}

function style_buttons()
{
	$("#datatable_paginate a").addClass("pure-button pure-button-primary pure-button-small");

	$("#datatable_previous").html("<i class=\"fa fa-arrow-left\"></i>");
	$("#datatable_next").html("<i class=\"fa fa-arrow-right\"></i>");

	$(".paginate_disabled_previous").attr("disabled", "disabled");
	$(".paginate_disabled_next").attr("disabled", "disabled");
}

function get_translations()
{
	return {
		"sProcessing": "Bezig...",
			"sLengthMenu": "_MENU_ resultaten weergeven",
			"sZeroRecords": "Geen resultaten gevonden",
			"sInfo": "_START_ tot _END_ van _TOTAL_ resultaten",
			"sInfoEmpty": "Geen resultaten om weer te geven",
			"sInfoFiltered": " (gefilterd uit _MAX_ resultaten)",
			"sInfoPostFix": "",
			"sSearch": "Zoeken:",
			"sEmptyTable": "Geen resultaten aanwezig in de tabel",
			"sInfoThousands": ".",
			"sLoadingRecords": "Een moment geduld aub - bezig met laden...",
			"oPaginate": {
				"sFirst": "Eerste",
				"sLast": "Laatste",
				"sNext": "&raquo;",
				"sPrevious": "&laquo;"
			}
		};
}