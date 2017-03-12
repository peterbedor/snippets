Wee.fn.make('likeable', {
	like: function(id, type, callback) {
		this.$private.like(id, type, callback);
	}
}, {
	like: function(id, type, callback) {
		Wee.api.post({
			url: '/likes',
			json: true,
			data: {
				type: type,
				id: id
			},
			success: function(data) {
				callback(data);
			}
		});
	}
});