$(function(){

	/* TimePicker */
	$(".timepicker").timepicker({
		defaultTime: '00:00',
		maxTime: {
			hour: 8
	    },
		showPeriodLabels: false
	});

	/* On form submit */
	$(".day-form").on("submit", function(event){

		$.ajax({
			type: 'POST',
			url: 'hours/postHours',
			data: $(this).serialize(),
			beforeSend:function(){
			},
			success:function(data){

				if($.urlParam('saved') == "true"){
					location.href = location.href;
				}
				else {
					location.href = location.href + '?saved=true';
				}
				return true;
			},
			error:function(response){

				console.log(response);
				alert("Er ging iets fout, de uren zijn niet opgeslagen");

				return false;
			}
		});

		event.preventDefault();

	});
});

$.urlParam = function(name){
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}