Wee.fn.make('extensions', {
	_construct: function() {
		var disabled = '-is-disabled',
			active = '-is-active';

		$.chain({
			disable: function() {
				this.addClass(disabled);

				return this;
			},

			enable: function() {
				this.removeClass(disabled);
			},

			isDisabled: function() {
				return this.hasClass(disabled);
			},

			isEnabled: function() {
				return ! this.hasClass(disabled);
			},

			toggleDisable: function() {
				this.toggleClass(disabled);

				return this;
			},

			activate: function() {
				this.addClass(active);

				return this;
			},

			toggleActive: function() {
				this.toggleClass(active);

				return this;
			},

			deactivate: function() {
				this.removeClass(active);

				return this;
			},

			isActive: function() {
				return this.hasClass(active);
			},

			isInactive: function() {
				return ! this.hasClass(active);
			},

			click: function(callback) {
				this.on('click', callback);

				return this;
			}
		});
	}
});