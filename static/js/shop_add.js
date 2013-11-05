define(function(require, exports, modules) {
	var self;
	var $ = require('jquery');
	exports.css = '/static/css/empty.css';
	exports.template = '/static/shtml/tpl/shop_add.shtml';
	exports.ready = ready;

	function ready() {
		$('input[type="submit"]').one('click', function(event) {
			var data = {};
			$('[name]').each(function(i,e) {
				data[$(e).attr('name')] = $(e).val();
			});
			$.post('/api/shops/', data, function(data, textStatus, xhr) {
				console.log(data);
			});
		});
	}
});