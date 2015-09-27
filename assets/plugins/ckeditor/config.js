CKEDITOR.editorConfig = function( config ) {
	config.toolbar = [
		[ 'Link' ],
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
		[ 'Bold', 'Italic', 'Underline' ],
		[ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ],
		[ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ]
	];
	config.removeButtons = 'Subscript,Superscript';
	config.format_tags = 'p;h1;h2;h3;pre';
	config.removeDialogTabs = 'image:advanced;link:advanced';
	//config.justifyClasses = [ 'AlignLeft', 'AlignCenter', 'AlignRight', 'AlignJustify' ];
};