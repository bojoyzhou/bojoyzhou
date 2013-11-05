define(function(require, exports, modules) {
	exports.get = function(id, url) {
		url = url || location.hash;
		var exp = new RegExp("\\b" + id + "=([^&]*)", "ig");
		var ret = exp.exec(url);
		return ret && ret[1] || '';
	};
	window.url = exports;
});