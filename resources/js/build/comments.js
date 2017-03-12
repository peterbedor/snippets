Wee.fn.make('comments', {
	init: function() {
		this.$private.init();

		Wee.mentions.init();
	},

	unload: function() {
		$.events.off('', '.comments');
		this.$private.path = '';
	}
}, {
	init: function() {
		this.bindEvents();

		this.url = $.routes.uri().path + '/comments';
	},

	bindEvents: function() {
		var scope = this;

		$.events.on({
			'ref:commentButton': {
				click: function() {
					var $comments = $('ref:comments');

					scope.comment(function(data) {
						// Append comment
						$comments.append(data);

						// Reset form
						$('ref:commentBody').val('');

						// Attach tribute event listeners to new textarea
						Wee.mentions.attach(
							$comments.children()
								.last()
								.find('textarea')[0]
						);
					});
				}
			},
			'ref:reply': {
				click: function() {
					$('ref:commentReply-' + $(this).data('id')).toggle();
				}
			},
			'ref:commentReplyButton': {
				click: function() {
					var id = $(this).data('id'),
						$body = $('ref:commentReplyBody-' + id),
						$replies = $('ref:replies-' + id);

					scope.reply({
						body: $body.val(),
						parentId: id
					}, function(response) {
						// Append new comment to comments
						$replies.append(response);

						// Attach tribute event listeners to new textarea
						Wee.mentions.attach(
							$replies.children()
								.last()
								.find('textarea')[0]
						);

						// Reset comment form
						$('ref:commentReply-' + id).toggle();
						$body.val('');
					});
				}
			}
		}, {
			namespace: 'comments'
		});
	},

	comment: function(callback) {
		this.submitComment({
			body: $('ref:commentBody').val()
		}, callback);
	},

	reply: function(data, callback) {
		this.submitComment({
			body: data.body,
			parentId: data.parentId
		}, callback);
	},

	submitComment: function(data, callback) {
		var scope = this;

		data = $.extend(data, {
			mentions: Wee.mentions.getMentions()
		});

		Wee.api.post({
			url: scope.url,
			data: data,
			success: function(response) {
				callback(response);

				// Rebind events
				$.setRef();
				scope.rebindEvents();

				// Remove all current mentions from store
				Wee.mentions.clearMentions();

				// TODO: probably want to just highlight the newly created block
				// TODO: instead of all of them.
				// Run highlight JS in case there was any code submitted
				Wee.highlight.init();
			}
		})
	},

	rebindEvents: function() {
		$.events.off('', '.comments');
		this.bindEvents();
	}
});