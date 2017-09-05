/*!
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Bootstraps JS,
*/

jQuery(function($) {

	$('button#save-category').on( 'click', function() 
	{
	    $(document).ajaxStart(function(e, xhr, opt){
	        $('button#save-category').html("Simpan <i class='fa fa-spinner fa-spin fa-fw'></i><span class='sr-only'>Loading...</span>");
	    });

	    if( $('input[name="cat-new"]').val() === '')
	    {
	    	alert('Nama kategori harus diisi!');
	    } else {
			$.post(base_url + '/post/add_new_category/', 
			{ 
				nama : $('input[name="cat-new"]').val(),
				parent : $('select[name="cat-parent"]').val()
			}, 
			function(data) 
			{
				if( data.status === 'failed')
					alert("Failed when saving data!");   

				if( data.result.parent ) 
				{
					var html = '<div class="checkbox">';
						html += '<input type="checkbox" name="categories[]" value="'+data.result_id+'" checked> <label>'+ data.result.nama +'</label>';
						html += '</div>';
					$('div.parent-'+data.result.parent ).append(html);
				} else {
					var html = '<div class="checkbox">';
						html += '<input type="checkbox" name="categories[]" value="'+data.result_id+'" checked> <label>'+ data.result.nama +'</label>';
						html += '</div>';
					$('div.box-select-category').append(html);
				}           
			});
	    }

		$(document).ajaxComplete(function(e, xhr, opt)
		{
			$('button#save-category').html("Simpan");
			$('#add-category').collapse('hide');
		});
	});


	$('button#save-topik').on( 'click', function() 
	{
	    $(document).ajaxStart(function(e, xhr, opt){
	        $('button#save-topik').html("Simpan <i class='fa fa-spinner fa-spin fa-fw'></i><span class='sr-only'>Loading...</span>");
	    });

	    if( $('input[name="tag-new"]').val() === '')
	    {
	    	alert('Nama Topik harus diisi!');
	    } else {
			$.post(base_url + '/post/add_new_tag/', 
			{ 
				nama : $('input[name="tag-new"]').val()
			}, 
			function(data) 
			{
				if( data.status === 'failed')
					alert("Failed when saving data!");   

				$('input[name="tag-new"]').val('')

				var html = '<option value="'+data.result_id+'" selected>' + data.result.nama + '</option>';
				$('select#select-topik').append(html);        
			});
	    }

		$(document).ajaxComplete(function(e, xhr, opt)
		{
			$('button#save-topik').html("Simpan");
			$('#add-topik').collapse('hide');
		});
	});

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

				var ID = $(this).data('id');

				$('a#btn-delete').on('click', function() 
				{
					$.get(base_url + '/menu/delete/' + ID);
					
				    $(document).ajaxComplete(function(e, xhr, opt)
				    {
				       	$('#modal-delete-menu').modal('hide');
				       	$('li.dd-item[data-id="'+ID+'"]').remove();
				    });
					
				});

				break;
			default:
				alert('Please input data-key="example-key" in attribut button.');
			break;
		}
	});

});