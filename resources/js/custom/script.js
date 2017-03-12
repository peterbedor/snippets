Wee.routes.map({
	'$any:once': [
		'common',
		// 'notifications'
	],
	'$any': 'notifications',
	'$root': 'snippets',
	'snippets': {
		'create': {
			'$root': 'createSnippet',
			'unload': 'createSnippet:unload'
		},
		'$slug': {
			'$root': [
				'showSnippet',
				'comments'
			],
			'$root:once': [
				'showSnippet:scrollToComment'
			],
			'unload': 'showSnippet:unload'
		}
	},
	'login': 'login'
});

Wee.ready('routes:run');