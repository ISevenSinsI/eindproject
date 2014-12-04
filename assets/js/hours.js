var notSaved;
var count;

jQuery(function($){
    $.timepicker.regional['nl'] = {
        hourText: 'Uren',
        minuteText: 'Minuten',
        amPmText: ['AM', 'PM'],
		closeButtonText: 'Sluiten',
		nowButtonText: 'Actuele tijd',
		deselectButtonText: 'Wissen' }
    $.timepicker.setDefaults($.timepicker.regional['nl']);
});

$(function(){

	// set notSaved
	notSaved = false;
	count = 0;

	// after page load
	getHours();

	// previous button
	$(".previous").on("click", function(){

		if(checkSaved()){
			$previous = $(".date").first().data("date");
			getHours($previous);
		}

		return false;
	});

	// next button
	$(".next").on("click", function(){

		if(checkSaved()){
			$next = $(".date").last().data("date");
			getHours($next);
		}

		return false;
	});

	// save button
	$(".save").on("click", function(){

		count = 0;

		postHours($(".form-previous"));
		postHours($(".form-current"));
		postHours($(".form-next"));

		return false;
	});

	// today button
	$(".loadToday").on("click", function(){

		if(checkSaved()){
			getHours();	
		}

		return false;
	});

	// on input change
	$("#hours").on("change", "input", function() {
		notSaved = true;
	});

	// toggle extra
	$("#hours").on("click", ".toggleExtra", function(){
		$(this).parent().find(".extra").toggle();

		$(this).find('.fa').toggleClass("fa-caret-square-o-down");
		$(this).find('.fa').toggleClass("fa-caret-square-o-up");

		return false;
	});

});

function getHours(date){

	$hours = $("#hours");

	// no date passed
	if(!date){
		var date = moment(new Date());
	}
	// date passed
	else {
		// convert to moment object
		var date = moment(date);
	}

	// set values in right format
	var current = date.format('YYYY-MM-DD');
	var previous = date.add('days', -1).format('YYYY-MM-DD');
	var next = date.add('days', 2).format('YYYY-MM-DD');

	$.ajax({
		type: 'POST',
		url: 'hours/getHours',
		data: {previous: previous, current: current, next: next},
		beforeSend:function(){
			$hours.css({ "opacity" : 0.4 });;

		},
		success:function(data){
			$hours.html(data);
			$(".timepicker").timepicker({
				defaultTime: '00:00',
				maxTime: {
					hour: 8
			    },
				showPeriodLabels: false
			});
			$(".timepicker_travelled").timepicker({
				defaultTime: '00:00',
				maxTime: {
					hour: 4
			    },
				showPeriodLabels: false
			});
			$hours.css({ "opacity" : 1 });;
		},
		error:function(response){
			console.log(response);
			$hours.html("Error");
		}
	});
}

function postHours(form){

	$.ajax({
		type: 'POST',
		url: 'hours/postHours',
		data: form.serialize(),
		beforeSend:function(){
		},
		success:function(data){
			form.find("input[name=id]").val(data);
			notSaved = false;

			count = count + 1;
			console.log(count);

			if(count > 2){
				getHours($(".form-current > .date").data("date"));

				$(".warning-bar").removeClass("fadeOutDown");
				$(".warning-bar").addClass("fadeInUp");
				setTimeout(function() {
					$(".warning-bar").addClass("fadeOutDown");
					$(".warning-bar").removeClass("fadeInUp");
				}, 3000);

			}

			return true;
		},
		error:function(response){
			return false;
		}
	});

}

function checkSaved(){

	if(notSaved == true){
		var confirm = window.confirm("Weet u zeker dat u deze pagina wilt verlaten? U heeft nog niet alles opgeslagen.")
		if(confirm) {
			return true;
		}
		else {
			return false;
		}
	}

	return true;

}