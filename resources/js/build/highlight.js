/* global hljs */

Wee.fn.make('highlight', {
	init: function() {
		if ($.assets.ready('highlight')) {
			this.$private.highlightBlocks();
		} else {
			this.$private.load();
		}
	},

	block: function(el) {
		this.$private.highlightBlock(el);
	},

	theme: function(theme) {
		this.$private.changeTheme(theme);
	}
}, {
	load: function() {
		var scope = this,
			theme = $.get('hljsTheme') || 'default.min.css';

		Wee.assets.load({
			root: '/assets/',
			group: 'highlight',
			js: [
				'js/lib/vendor/hljs.min.js',
				'js/lib/vendor/hljs.linenumbers.min.js'
			],
			css: 'css/lib/vendor/hljs/' + theme,
			success: function() {
				scope.highlightBlocks();
			}
		});
	},

	highlightBlocks: function() {
		var scope = this;

		$('pre code').each(function(block) {
			scope.highlightBlock(block);
		});
	},

	highlightBlock: function(block) {
		hljs.highlightBlock(block);
		hljs.lineNumbersBlock(block);
	},

	changeTheme: function(theme) {
		Wee.assets.load({
			root: '/assets/',
			css: 'css/lib/vendor/hljs/' + theme
		});
	}
});