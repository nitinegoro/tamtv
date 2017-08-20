$(function() 
{
	$('#select-topik').select2();

	tinymce.init({
		selector: ".tinymce",
		toolbar_items_size: 'small',
		theme: "modern",
		plugins: [
			" autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality paste textcolor importcss colorpicker"
		],
		external_plugins: {
			//"moxiemanager": "/moxiemanager-php/plugin.js"
		},
		//content_css: base_path + "/tinymce/tests/manual/css/development.css",
		add_unload_trigger: false,
		toolbar: 
		"undo redo | " +
		"bold italic underline hr | forecolor backcolor | fontsizeselect "+
		"alignleft aligncenter alignright alignjustify | "+
		"bullist numlist outdent indent  | link image media table insertdatetime | code visualblocks ",
		image_advtab: true,
		link_class_list: [
			{title: 'Green', value: 'example1'},
			{title: 'Red', value: 'example2'},
			{title: 'Yellow', value: 'example2'},
			{title: 'Grey', value: 'example2'}
		],
		image_class_list: [
			{title: 'Responsive', value: 'img-responsive'},
			{title: 'Rounded', value: 'img-rounded'},
			{title: 'Responsive Right', value: 'img-responsive pull-right'},
			{title: 'Responsive Left', value: 'img-responsive pull-left'}
		]
	});


});