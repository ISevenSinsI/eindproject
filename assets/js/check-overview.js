$(function(){

	$employees = $("#employees");
	$year = $employees.data("year");
	$month = $employees.data("month");
	$agency_id = $employees.data("agencyid");
	getMonthOverviewAjax($year, $month, $agency_id);

	$(".previous").on("click", function(event){
		
		$month = $employees.data("month");
		$year = $employees.data("year");

		$month = $month - 1;
		if($month == 0){
			$month = 12;
			$year = $year-1;
		}
		
		$agency_id = $employees.data("agencyid");
		getMonthOverviewAjax($year, $month, $agency_id);

		$employees.data("month", $month);
		$employees.data("year", $year);

		event.preventDefault();
	});

	$(".next").on("click", function(event){
		
		$month = $employees.data("month");
		$year = $employees.data("year");

		$month = $month + 1;
		if($month == 13){
			$month = 1;
			$year = $year+1;
		}
		
		$agency_id = $employees.data("agencyid");
		getMonthOverviewAjax($year, $month, $agency_id);

		$employees.data("month", $month);
		$employees.data("year", $year);
		
		event.preventDefault();
	});

});

function getMonthOverviewAjax($year, $month, $agency_id){

	$employees = $("#employees");

	$.ajax({
		type: 'POST',
		url: 'check/getMonthOverviewAjax',
		data: {agency_id: $agency_id, year: $year, month: $month},
		beforeSend:function(){
			$employees.css({ "opacity" : 0.4 });;

		},
		success:function(data){
			$employees.html(data);
			
			$employees.css({ "opacity" : 1 });;
		},
		error:function(response){
			console.log(response);
			$employees.html("Error");
		}
	});
}