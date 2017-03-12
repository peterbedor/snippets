Wee.fn.make('comments', {
	init: function() {
		var priv = this.$private;

		priv.bindEvents();

		Wee.mentions.init();
	},

	unload: function() {
		$.events.off('', '.comments')
	}
}, {
	bindEvents: function() {
		var scope = this;

		$.events.on({
			'ref:commentButton': {
				click: function() {
					scope.submitComment(false, $('ref:commentBody'));
				}
			},
			'ref:reply': {
				click: function() {
					$('ref:commentReply-' + $(this).data('id')).toggle();
				}
			},
			'ref:commentReplyButton': {
				click: function() {
					scope.submitComment(
						$(this).data('id')
					);
				}
			}
		}, {
			namespace: 'comments'
		});
	},

	submitComment: function(id) {
		var scope = this,
			$content = $('ref:commentReplyBody-' + id),
			$context = $content.parents('ref:comment-' + id),
			slug = $context.data('snippet');

		Wee.api.post({
			url: '/snippets/' + slug + '/comments',
			data: {
				body: $content.val(),
				parentId: id,
				mentions: Wee.mentions.getMentions()
			},
			success: function(data) {
				var $reply = $('ref:replies-' + id);

				// Append comment to parent
				$reply.append(data);

				Wee.mentions.attach(
					$reply.children().last().find('textarea')[0]
				);

				// Reset comment form
				$('ref:commentReply-' + id).toggle();
				$content.val('');

				$.setRef();

				scope.rebindEvents();

				Wee.mentions.clearMentions();
			}
		});
	},

	rebindEvents: function() {
		$.events.off('', '.comments');
		this.bindEvents();
	}
});