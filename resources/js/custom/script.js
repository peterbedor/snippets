Wee.routes.map({
	'$any:once': [
		'common',
		// 'notifications'
	],
	'$any': 'notifications',
	'$root': 'snippets',
	'favorites': 'snippets',
	'favorites:unload': 'snippets:unload',
	'languages': {
		'$slug': 'snippets',
		'$slug:unload': 'snippets:unload'
	},
	'users': {
		'$slug': {
			'$root': 'snippets',
			'$root:unload': 'snippets:unload',
			'favorites': 'snippets',
			'favorites:unload': 'snippets:unload'
		},
	},
	'snippets': {
		'create': {
			'$root': 'createSnippet',
			'$root:unload': 'createSnippet:unload'
		},
		'$slug': {
			'$root': [
				'showSnippet',
				'comments'
			],
			'$root:once': [
				'showSnippet:scrollToComment'
			],
			'$root:unload': 'showSnippet:unload'
		}
	},
	'login': 'login',
	'settings': 'settings'
});

Wee.ready('routes:run');