$(function() 
{
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
		style_formats: [
			{title: 'Bold text', format: 'h1'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		],

		link_class_list: [
			{title: 'Example 1', value: 'example1'},
			{title: 'Example 2', value: 'example2'}
		],

		image_class_list: [
			{title: 'Responsive', value: 'img-responsive'},
			{title: 'Rounded', value: 'img-rounded'}
		]
	});


});