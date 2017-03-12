Wee.fn.make('common', {
	init: function() {
		this.$private.initHistory();
	}
}, {
	initHistory: function() {
		Wee.history.init({
			bind: {
				click: 'a:not([data-static])'
			},
			partials: 'title,main',
			request: {
				success: function() {
					//
				},
				error: function(xhr) {
					$._win.location = xhr.responseURL;
				}
			}
		});
	}
});