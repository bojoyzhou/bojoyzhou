define('layout', function(require, exports, module) {
	var $ = require('jquery');
	var tpl = require('handlerbars');
	var cfg = {
		layout: {},
		stack: []
	};
	exports.index = '';
	exports.config = cfg;
	exports.start = start;
	window.onhashchange = hashchange;

	function start(view) {
		if (exports.index) {
			return;
		}
		exports.index = view;
		if (document && document.body) {
			hashchange();
		} else {
			window.addEventListener('load', function() {
				hashchange();
			});
		}
	}

	function hashchange() {
		var oldView, newView, view, stack = cfg.stack,
			destroy;
		newView = getView() || (location.hash = exports.index, exports.index);
		view = cfg.layout[newView] || new Layout(newView);
		cfg.layout[newView] = view;
		if (stack.length) {
			oldView = stack[stack.length - 1];
			destroy = cfg.layout[oldView].view.destroy
			if (destroy && destroy() === false) {
				cfg.layout[oldView].hide();
			} else {
				cfg.layout[oldView].destroy();
				cfg.layout[oldView] = null;
				delete cfg.layout[oldView];
			}
		}
		stack.push(newView);
		view.run();
	}

	function getView() {
		var mat = location.hash.match(/layout=([^&]*)/i);
		return mat && mat[1] || exports.index;
	}

	function Layout(id) {
		this.id = id;
	}

	Layout.prototype = {
		run: function() {
			var that = this;
			var act;
			if (!this.view) {
				var that = this;
				require.async(this.id, function(m) {
					that.viewport = m.viewport;
					var templateStr = $.ajax({
						url: m.template,
						async: false
					}).responseText;
					that.template = tpl.compile(templateStr);
					that.data = m.data;
					that.css = m.css;
					that.adapter = m.adapter;
					that.events = [];
					that.view = m;
					m.super = that;
					that.state = 'destroy';

					that.nextTick();
				});
			} else {
				this.nextTick();
			}
		},
		nextTick: function() {
			var nextState;
			nextState = act = this.getnext();
			if (this.view[act]) {
				this.view[act].call(this.view);
				this.state = nextState;
				this.nextTick();
			} else if (this[act]) {
				this[act].call(this);
				this.state = nextState;
				this.nextTick();
			}
		},
		pause:function(){
			this.pauseFlag=1;
		},
		resume:function(){
			this.pauseFlag=0;
			this.nextTick();
		},
		getnext: function() {
			if(this.pauseFlag){
				return ;
			}
			return {
				create: 'show',
				show: 'ready',
				ready: '',
				hide: 'show',
				destroy: 'create'
			}[this.state];
		},
		create: function() {
			this.element = $(document.createElement('div'));
			this.element.attr('id', this.id);
			if (this.css) {
				this.cssElement = document.createElement('link');
				this.cssElement.rel = "stylesheet";
				this.cssElement.href = this.css;
				document.head.insertBefore(this.cssElement);
			}
			if (typeof this.data === 'string') {
				var that = this;
				this.pause();
				$.get(that.data, function(data) {
					data = that.adapter && that.adapter(data) || data;
					var html = that.template(data);
					that.element.append(html);
					that.resume();
				});
			} else {
				this.element.append(this.template(this.data));
			}
		},
		show: function() {
			if (this.state === 'create') {
				this.viewport = this.viewport && $('#' + this.viewport) || $(document.body);
				this.viewport.append(this.element);
			} else {
				this.element.show();
			}
		},
		ready: function() {

		},
		hide: function() {
			this.element.hide();
			this.state = 'hide';
		},
		destroy: function() {
			this.element.off();
			this.element.remove();
			$(this.cssElement).remove();
			this.cssElement = null;
			this.element = null;
		},
		back: function() {
			history.go(-1);
		},
		forward: function() {
			history.go(1);
		},
		on: function(type, selector, callback) {
			this.events.push(arguments);
			this.element.on.apply(this.element, arguments);
		},
		off: function() {
			this.element.off.apply(this.element, arguments);
		}
	};
});