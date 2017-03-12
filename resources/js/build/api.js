Wee.fn.make('api', {
	get: function(conf) {
		this.$private.send(conf);
	},

	post: function(conf) {
		this.$private.send($.extend(true, {
			method: 'post'
		}, conf));
	},

	put: function(conf) {
		this.$private.send($.extend(true, {
			method: 'put'
		}, conf));
	},

	delete: function(conf) {
		this.$private.send($.extend(true, {
			method: 'delete'
		}, conf));
	}
}, {
	send: function(conf) {
		Wee.fetch.request($.extend({
			headers: {
				'X-CSRF-TOKEN': $.get('csrfToken')
			}
		}, conf));
	}
});