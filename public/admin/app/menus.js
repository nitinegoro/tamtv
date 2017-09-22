jQuery(function($) {
	/*
	* Nestable Structure Menu
	*/
	$('.dd').nestable({
			maxDepth : 2,
	}).on('change', updateOutput);
				
	$('div.button-action').on('mousedown', function(event) {
		event.preventDefault();
		return false;
	});

	updateOutput($('#nestable2').data('output', $('#nestable-output')));

	$('form#save-menu').submit(function(event) 
	{
		event.preventDefault(); 

		var ID = $(this).data('id');

	    $(document).ajaxStart(function(e, xhr, opt){
	        $('button#save-menu[data-id="'+ID+'"]').html("Simpan <i class='fa fa-spinner fa-spin fa-fw'></i><span class='sr-only'>Loading...</span>");
	    });

		$.post(base_url + '/menu/ajaxupdate/' + ID, 
		{ 
			label : $('input#label-' + ID).val(),
			target : $('select#target-' + ID).val(),
			url : $('input#url-' + ID).val()
		}, 
		function(data) 
		{
			if( data.status === 'failed')
				alert("Failed when saving data!");               
		});

	    $(document).ajaxComplete(function(e, xhr, opt){
	        $('button#save-menu[data-id="'+ID+'"]').html("Simpan");
	        $("#collapse-" + ID).collapse('hide');
	    });

		return false;
	})
});

var last_touched = '';
var updateOutput = function(e)
{
	var list   = e.length ? e : $(e.target),
		output = list.data('output');
	if (window.JSON) {
		output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
		//Need to send altered array through here!
		$.post(base_url + '/menu/updatestructure', 
		{ 
			'whichnest' : last_touched, 
			'output' : output.val(),
			'key' : $('#nestable-output').data('key')
		}, 
		function(data) 
		{
			                    
		});
	} else {
		output.val('JSON browser support required for this feature.');
	}
};

function getlabelstring(element, value) 
{
	$('span#label-' + element ).html(value);
}

