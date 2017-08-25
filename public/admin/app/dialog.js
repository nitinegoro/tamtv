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
			case 'tag':
				$('#modal-delete-tag').modal('show');
				$('a#btn-delete').attr('href', base_url + '/post_tags/delete/' + $(this).data('id'));
				break;
			case 'category':
				$('#modal-delete-category').modal('show');
				$('a#btn-delete').attr('href', base_url + '/post_category/delete/' + $(this).data('id'));
				break;
			case 'post':
				$('#modal-delete-post').modal('show');
				$('a#btn-delete').attr('href', base_url + '/post/delete/' + $(this).data('id'));
				break;
			case 'page':
				$('#modal-delete-page').modal('show');
				$('a#btn-delete').attr('href', base_url + '/pages/delete/' + $(this).data('id'));
				break;
			case 'menu':
				$('#modal-delete-menu').modal('show');
				$('a#btn-delete').attr('href', base_url + '/menu/delete/' + $(this).data('id'));
				break;
			default:
				alert('Please input data-key="example-key" in attribut button.');
			break;
		}
	});

});