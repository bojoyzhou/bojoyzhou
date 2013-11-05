define(function(require, exports, modules) {
	var self;
	var $ = require('jquery');
	var url = require('url');
	var id = url.get('id');
	exports.css = '/static/css/empty.css';
	exports.template = '/static/shtml/tpl/shop.shtml';
	exports.adapter = function(data) {
		return data.data[0];
	}
	exports.data = '/api/shops/' + id;
	exports.ready = ready;

	function ready() {

	}
});