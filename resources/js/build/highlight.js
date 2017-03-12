/* global hljs */

Wee.fn.make('highlight', {
	init: function() {
		if ($.assets.ready('highlight')) {
			this.$private.highlightBlocks();
		} else {
			this.$private.load();
		}
	}
}, {
	load: function() {
		Wee.assets.load({
			root: '/assets/',
			group: 'highlight',
			js: [
				'js/lib/vendor/hljs.min.js',
				'js/lib/vendor/hljs.linenumbers.min.js'
			],
			css: 'css/lib/vendor/hljs/tomorrow.min.css',
			success: function() {
				hljs.initHighlightingOnLoad();
				hljs.initLineNumbersOnLoad();
			}
		});
	},

	highlightBlocks: function() {
		$('pre code').each(function(block) {
			hljs.highlightBlock(block);
			hljs.lineNumbersBlock(block);
		});
	}
});