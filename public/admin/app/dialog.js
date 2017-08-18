/*!
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Bootstraps JS,
*/

jQuery(function($) {

	$('a[data-action="delete"]').click( function() 
	{
		switch($(this).data('key'))
		{
			case 'user':
				$('#modal-delete-user').modal('show');
				$('a#btn-delete').attr('href', base_url + '/users/delete/' + $(this).data('id'));
			break;
			default:
				alert('Please input data-key="example-key" in attribut button.');
			break;
		}
	});

});