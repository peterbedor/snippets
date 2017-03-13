Wee.fn.make('notifications', {
	init: function() {
		this.$private.init();
	}
}, {
	init: function() {
		this.$panel = $('ref:notificationsPanel');
		this.$countBubble = $('ref:notifications');
		this.count = parseInt(this.$countBubble.text());

		this.bindEvents();

		$._win.setInterval(this.ping.bind(this), 5000);
	},

	bindEvents: function() {
		var scope = this;

		this.$countBubble.on('click', function() {
			scope.$panel.toggle();
		}, {
			namespace: 'notifications'
		});

		$('ref:markAsRead').on('click', function() {
			var $this = $(this);

			scope.markAsRead($this.data('id'), $this);
		}, {
			namespace: 'notifications'
		});

		$('ref:markAllAsRead').on('click', function() {
			scope.markAsRead();
		});
	},

	markAsRead: function(id, $el) {
		var scope = this;

		Wee.api.post({
			url: '/notifications',
			json: true,
			data: {
				id: id
			},
			success: function(data) {
				if (data) {
					if ($el) {
						$el.parent().remove();
					} else {
						$('ref:notificationsList').children().remove();
					}
				}
			}
		});
	},

	ping: function() {
		var scope = this;

		Wee.api.get({
			url: '/notifications/unread',
			json: true,
			success: function(data) {
				var notifications = data.html,
					newCount = data.count;

				if (newCount > scope.count) {
					scope.$countBubble.text(newCount);
					scope.$panel.html(notifications);
				}
			}
		})
	}
});