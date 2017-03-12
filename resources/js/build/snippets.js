/* global hljs */

Wee.fn.make('snippets', {
	init: function() {
		var p = this.$private;

		p.bindEvents();

		Wee.highlight.init();
	},

	unload: function() {
		$.events.off(false, '.snippets');
	}
}, {
	/**
	 * Bind events
	 */
	bindEvents: function() {
		var scope = this;

		$.events.on({
			'ref:likeSnippet': {
				click: function(e, el) {
					var $el = $(el);

					Wee.likeable.like(
						$el.data('id'),
						'snippet',
						function(data) {
							scope.handleLike($el, data);
						}
					);
				}
			},
			'ref:snippetBody': {
				click: function(e, el) {
					Wee.history.go({
						path: '/snippets/' + $(el).data('slug')
					});
				}
			}
		}, {
			namespace: 'snippets'
		});
	},

	/**
	 * Handle the like
	 *
	 * @param $el
	 * @param data
	 */
	handleLike: function($el, data) {
		var $count = $el.parents('ref:snippet')
				.find('ref:snippetLikesCount');

		if (data.success) {
			$el.toggleActive();
			$count.text(data.count);
		}
	}
});