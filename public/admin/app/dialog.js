/*!
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Bootstraps JS,
*/

jQuery(function($) {
	/*
	*  ADD CATEGORY IN CREATE/UPDATE POST
	*/
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

	/*
	*  ADD TAGS IN CREATE/UPDATE POST
	*/
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

	/*
	*  ADD PHOTOS IN CREATE/UPDATE POST
	*/
	var counter = 5;

	$('button#add-file').on('click', function()
	{
		var html =  '<div class="margin-bottom" id="photo-'+counter+'">';
			html += '<button type="button" id="delete-file" data-id="'+counter+'" class="btn btn-xs pull-right"><i class="fa fa-times"></i> Hapus</button>';
			html += '<input name="photo[]" type="file">';
			html += '<textarea class="form-control top2x" name="caption[]" placeholder="Keterangan gambar ..."></textarea>';
			html += '</div>';

		$(html).appendTo('.galery').hide().fadeIn(500);

		$('button#delete-file').on('click', function()
		{
			counter--;
			$('div#photo-'+$(this).data('id')).fadeOut(300, function() {
				$(this).remove();
			});
		});
		counter++;
	});

	/*
	* ADD FORM Perasaan
	*/
	var minFormUpload = $('div.form-dynamic').data('start');
	
	$('button#addFormUpload').on('click', function() 
	{
		var html  = '<div class="form-group" id="form-'+minFormUpload+'">';
			html += '<button type="button" class="btn btn-xs btn-danger pull-right bottom1x" id="delete-form" data-id="'+minFormUpload+'"><i class="fa fa-times"></i></button>';
			html += '<input type="file" name="perasaan[]">';
			html += '<input type="text" class="form-control top1x" name="jawaban[]" required>';
			html += '</div>';

		$(html).appendTo('div.form-dynamic').hide().fadeIn(500);

		$('button#delete-form').on('click', function() 
		{
			minFormUpload--;
			$('div#form-' + $(this).data('id')).fadeOut(300, function() {
				$(this).remove();
			})
		});
	});


	/* COMMENT REPLY  */
	$('button#set-reply').on('click', function(argument) 
	{
	    $(document).ajaxStart(function(e, xhr, opt){
	        $('button#set-reply').html("Mengirim... <i class='fa fa-spinner fa-spin fa-fw'></i><span class='sr-only'></span>");
	    });

	    if( $('textarea[name="comment_reply"]').val() === '')
	    {
	    	alert('Balasan tidak boleh kosong!');

	    	$('textarea[name="comment_reply"]').focus()
	    } else {
			$.post(base_url + '/cm/reply/', 
			{ 
				comment_reply : $('textarea[name="comment_reply_'+$(this).data('id')+'"]').val(),
				comment_post : $(this).data('post'),
				parent : $(this).data('id')
			}, 
			function(data) 
			{
				if( data.status === 'failed') 
				{
					alert("Failed when saving data!");   
				} else {
					window.location.reload();
				}

				$('textarea[name="comment_reply"]').val();     
			});
	    }

		$(document).ajaxComplete(function(e, xhr, opt)
		{
			$('button#set-reply').html("Balas");
			$('#reply-' + $(this).data('id')).collapse('hide');
		});
	});

	/* COMMENT STATUS */
	$('a#set-status').on('click', function() 
	{
		var comment = $(this).data('id')
			status = $(this).data('status');

		$.post(base_url + '/cm/approved/' + comment, 
		{ 
			status : status
		}, 
		function(data) 
		{
			if( data.status === 'failed') 
			{
				alert("Failed when saving data!");   
			} else {
				if( status === 'yes') 
				{
					var newButton = '<a id="set-status" data-id="'+comment+'" data-status="no" class="text-yellow">Tolak</a>';
				} else {
					var newButton = '<a id="set-status" data-id="'+comment+'" data-status="yes" class="text-success">Terima</a>';
				}

				$('div#action-' + comment).prepend(newButton).fadeIn(300);

				$('div#action-'+comment+'>a:nth-child(2)').fadeOut(300, function() {
					$(this).remove();
				});
			} 
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
			case 'comment':
				$('#modal-delete-comment').modal('show');
				$('a#btn-delete').attr('href', base_url + '/cm/delete/' + $(this).data('id'));
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
			case 'photo':
				var ID = $(this).data('id');
				$.post(base_url + '/post/delete_galery/' + ID, function(result) 
				{
					$(document).ajaxComplete(function(e, xhr, opt)
					{
						if( result.status === 'success')
						{
							$('div#photo-' + ID).fadeOut(300, function() {
								$(this).remove();
							});
						} else {
							alert("Terjadi kesalahan saat menhapus data!");
						}
					});
				});
				break;
			case 'question':
				$('#modal-delete-question').modal('show');
				$('a#btn-delete').attr('href', base_url + '/question/delete/' + $(this).data('id'));
				break;
			case 'answer':
				$('#modal-delete-answer').modal('show');
				var ID =  $(this).data('id');

				$('a#btn-delete').on('click', function() 
				{
					$.post(base_url + '/question/deleteanswer/' + ID, function(result) 
					{
						$('#modal-delete-answer').modal('hide');

						$(document).ajaxComplete(function(e, xhr, opt)
						{
							if( result.status === 'success')
							{
								$('div#answer-' + ID).fadeOut(300, function() {
									$(this).remove();
								});
							} else {
								alert("Terjadi kesalahan saat menhapus data!");
							}
						});
					});
				});
				break;
			default:
				alert('Please input data-key="example-key" in attribut button.');
			break;
		}
	});

});