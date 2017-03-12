Wee.fn.make('mentions', {
	init: function() {
		this.$private.init();
	},

	getMentions: function() {
		return this.$private.mentions;
	},

	clearMentions: function() {
		this.$private.mentions = [];
	},

	attach: function(el) {
		this.$private.tribute.attach(el);
		this.$private.addEventListener(el);
	}
}, {
	init: function() {
		this.getUsers();

		this.$inputs = $('ref:weeMention');
	},

	initializeTribute: function(users) {
		var scope = this;

		scope.mentions = [];

		scope.tribute = tribute = new Tribute({
			values: users,
			lookup: function(person) {
				return person.first_name + ' ' + person.last_name;
			},
			fillAttr: 'username',
			menuItemTemplate: function(item) {
				return '<img src="' + item.original.avatar + '" class="tribute-avatar">' + item.string;
			}
		});

		scope.$inputs.each(function(input) {
			scope.tribute.attach(input);
			scope.addEventListener(input);
		});
	},

	addEventListener: function(input) {
		var scope = this;

		input.addEventListener('tribute-replaced', function(e) {
			scope.saveMention(e.detail);
		});
	},

	saveMention: function(username) {
		username = username.slice(1, username.length);

		this.mentions.push(username);
	},

	getUsers: function() {
		var scope = this;

		Wee.api.get({
			url: '/users/list',
			json: true,
			success: function(users) {
				scope.initializeTribute(users);
			}
		});
	}
});