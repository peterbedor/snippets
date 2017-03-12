Wee.fn.make('infieldLabels', {
	_construct: function() {
		this.namespace = 'infieldLabels';
	},

	/**
	 * Init infield labels module
	 *
	 * @param {object} options
	 * @param {string} [options.selector=ref:infieldInput] - Selector for the infield label input.
	 * @param {string} [options.focusClass=-is-focused] - Class added when input is focused.
	 * @param {string} [options.activeClass=-is-active] - Class added when the input has a value.
	 */
	init: function(options) {
		var settings = $.extend({
				selector: 'ref:infieldInput',
				focusClass: '-is-focused',
				activeClass: '-is-active'
			}, options),
			$selector = $(settings.selector),
			focusClass = settings.focusClass,
			activeClass = settings.activeClass;

		$selector.each(function(el) {
			var $el = $(el);

			if ($el.val()) {
				$el.parent()
					.addClass(activeClass);
			} else {
				$el.parent()
					.addClass('-transition');
			}
		});

		$selector.on('focus.' + this.namespace, function(e, el) {
			$(el).parent()
				.addClass(activeClass + ' ' + focusClass);
		});

		$selector.on('blur.' + this.namespace, function(e, el) {
			var $el = $(el);

			$el.parent()
				.removeClass(focusClass);

			if (! $el.val()) {
				$el.parent()
					.removeClass(activeClass);
			}
		});
	},

	/**
	 * Destroy infield label bind events
	 */
	destroy: function() {
		$.events.off(false, '.' + this.namespace);
	}
});