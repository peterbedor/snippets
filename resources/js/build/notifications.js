Wee.fn.make('notifications', {
	init: function() {
		this.$private.init();
	}
}, {
	init: function() {
		this.$count = $('ref:notifications');
		this.$markAsRead = $('ref:markAsRead');
		this.$panel = $('ref:notificationsPanel');
		this.$list = $('ref:notificationsList');
		this.bindEvents();

		this.startPinging();

		this.currentCount = parseInt(
			this.$count.text()
		);
	},
	bindEvents: function() {
		var scope = this;

		this.$count.on('click.notifications', function() {
			scope.$panel.toggle();
		}, {
			delegate: 'ref:header'
		});

		this.$markAsRead.on('click.notifications', function() {
			var $this = $(this);

			scope.markAsRead(
				$this.data('id'),
				$this
			)
		}, {
			delegate: 'ref:header'
		});

		$('ref:markAllAsRead').on('click.notifications', function() {
			scope.markAsRead();
		}, {
			delegate: 'ref:header'
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
				scope.updateNotifications(data.payload, $el);
			}
		});
	},

	updateNotifications: function(data, $el) {
		if (! data.length) {
			this.$count.parent().hide();
		} else {
			this.$count.text(data.length);
		}

		this.$panel.toggle();

		$el.parent().remove();
	},

	startPinging: function() {
		var scope = this;

		$._win.setInterval(function() {
			scope.ping();
		}, 5000);
	},

	ping: function() {
		var scope = this;

		Wee.api.get({
			url: '/notifications/unread',
			json: true,
			success: function(data) {
				var notifications = data.html,
					newCount = data.count;

				if (newCount > scope.currentCount) {
					scope.updateCount(newCount);
					scope.updateNotificationsList(notifications);
				}
			}
		})
	},

	updateNotificationsList: function(notifications) {
		this.$panel.html(notifications);
	},

	updateCount: function(count) {
		this.$count.text(count);
	}
});