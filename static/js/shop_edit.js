define(function(require, exports, modules) {
	var self;
	var $ = require('jquery');
	var url = require('url');
	var id = url.get('id');
	exports.css = '/static/css/empty.css';
	exports.template = '/static/shtml/tpl/shop_edit.shtml';
	exports.data = '/api/shops/' + id;
	exports.adapter = function(data) {
		return data.data[0];
	}
	exports.ready = ready;

	function ready() {
		$('input[type="submit"]').one('click', function(event) {
			var id=url.get('id');
			var data = {};
			$('[name]').each(function(i,e) {
				data[$(e).attr('name')] = $(e).val();
			});
			$.put('/api/shops/'+id, data, function(data, textStatus, xhr) {
				console.log(data);
			});
		});
	}
});