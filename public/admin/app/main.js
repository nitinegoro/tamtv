jQuery(function($) {

    /* DATEPICKER */
    $('#datepicker1, #datepicker2').daterangepicker({
        singleDatePicker: true,
        format:'YYYY-MM-DD', 
    });
    
	$("div.sticker").sticky({topSpacing:20, bottomSpacing:100});
	
	$('form#save-streaming').submit(function(event) 
	{
		event.preventDefault(); 

		var ID = $(this).data('id');

	    $(document).ajaxStart(function(e, xhr, opt){
	        $('button#saveStreaming').html("Simpan <i class='fa fa-spinner fa-spin fa-fw'></i><span class='sr-only'>Loading...</span>");
	    });

		$.post(base_url + '/administrator/updatelive/', 
		{ 
			live : $('input[name="live"]').val()
		}, 
		function(data) 
		{
			if( data.status === 'failed')
				alert("Failed when saving data!");               
		});

	    $(document).ajaxComplete(function(e, xhr, opt){
	        $('button#saveStreaming').html("Simpan");
	    });

		return false;
	})
});