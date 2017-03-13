Wee.fn.make('flash', {
	error: function(conf) {
		this.$private.flash('error', {
			message: conf.message || 'There was an error'
		});
	},

	success: function(conf) {
		this.$private.flash('success', {
			message: conf.message || 'Success'
		});
	}
}, {
	flash: function(type, conf) {
		var $flash = $('ref:flash');
		conf = $.extend(conf, {
			delay: 2000
		});

		$flash.toggle()
			.addClass('-' + type)
			.html(
				$.view.render('flash.message', {
					message: conf.message
				})
			);

		$._win.setTimeout(function() {
			$flash.hide()
				.removeClass('-' + type);
		}, conf.delay)
	}
});