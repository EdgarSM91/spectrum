CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];
    config.qtRows= 7, // Count of rows
    config.qtColumns= 8, // Count of columns
    config.qtBorder= '1', // Border of inserted table
    config.qtWidth= '90%', // Width of inserted table
    config.qtStyle= { 'border-collapse' : 'collapse' },
    config.qtClass= 'test', // Class of table
    config.qtCellPadding= '0', // Cell padding table
    config.qtCellSpacing= '0', // Cell spacing table
    config.qtPreviewBorder= '4px double black', // preview table border
    config.qtPreviewSize= '4px', // Preview table cell size
    config.qtPreviewBackground= '#c8def4' // preview table background (hover)

    config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
    config.language = 'es';
    config.height = 300;
    config.toolbarCanCollapse = true;
    config.extraPlugins = 'youtube,colorbutton,justify,tableresize,font,quicktable,panelbutton';
    config.font_names="'Roboto',sans-serif;";
    //config.filebrowserBrowseUrl= '/browser/browse.php?type=Images',
    config.filebrowserUploadUrl= '/dashboard/notes/uploadmultipleimages'
};
