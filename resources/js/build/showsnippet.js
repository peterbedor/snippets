/* global Clipboard */

Wee.fn.make('showSnippet', {
	init: function() {
		Wee.highlight.init();

		this.$private.loadClipboardJs();
	},

	/**
	 * Unload
	 */
	unload: function() {
		this.$private.destroyClipboardJs();
	},

	/**
	 * Scrolls to comment if set in the location hash
	 */
	scrollToComment: function() {
		var $comment = $($._win.location.hash);

		if ($comment.length) {
			Wee.animate.tween('ref:main', {
				scrollTop: ($comment.offset().top - 100)
			});
		}
	}
}, {
	/**
	 * Load in clipboard js assets
	 */
	loadClipboardJs: function() {
		var scope = this;

		$.assets.load({
			js: '/assets/js/lib/vendor/clipboard.min.js',
			success: function() {
				scope.initClipboardJs();
			}
		});
	},

	/**
	 * Initialize clipboard js
	 */
	initClipboardJs: function() {
		var scope = this,
			$copy = $('ref:copy');

		scope.clipboards = [];

		$copy.each(function(copy) {
			var clipboard = new Clipboard(copy);

			clipboard.on('success', function() {
				Wee.flash.success({
					message: 'Copied to clipboard!'
				});
			});

			clipboard.on('error', function() {
				Wee.flash.error({
					message: 'There was an error'
				});
			});

			scope.clipboards.push(clipboard);
		});
	},

	/**
	 * Destroy all clipboard JS instances
	 */
	destroyClipboardJs: function() {
		var clipboards = this.clipboards,
			i = 0;

		for (; i < clipboards.length; i += 1) {
			clipboards[i].destroy();
		}
	}
});