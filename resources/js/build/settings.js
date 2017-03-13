Wee.fn.make('settings', {
	init: function() {
		this.$private.init();
	}
}, {
	init: function() {
		this.bindEvents();
	},

	bindEvents: function() {
		var scope = this;

		$('ref:theme').on('change', function(e, el) {
			scope.changeTheme(el.value)
		});
	},

	changeTheme: function(theme) {
		Wee.api.post({
			url: '/settings/theme',
			json: true,
			data: {
				theme: theme
			},
			success: function(data) {
				Wee.highlight.theme(data.theme)
			}
		})
	}
});