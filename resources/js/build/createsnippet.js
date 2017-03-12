Wee.fn.make('createSnippet', {
	/**
	 * Init
	 */
	init: function() {
		this.$private.initAceEditor();
	},

	/**
	 * Unload
	 */
	unload: function() {
		$.events.off(false, '.createSnippet');
	}
}, {
	initAceEditor: function() {
		var scope = this;

		$.assets.load({
			root: '//cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/',
			js: 'ace.js',
			success: function() {
				scope.initEditor();
			}
		})
	},

	initEditor: function() {
		var editor = ace.edit($('ref:editor')[0]);

		editor.setTheme("ace/theme/monokai");
		editor.getSession().setMode("ace/mode/javascript");
	}
});