define(function(require, exports, modules) {
	var self;
	var $ = require('jquery');
	exports.css = '/static/css/empty.css';
	exports.template = '/static/shtml/tpl/map.shtml';
	exports.ready = ready;

	function ready() {
		var map = window.map = new google.maps.Map($("#map").get(0));
		map.setCenter(new google.maps.LatLng(40.71156, -73.95925));
		map.setZoom(13);
		map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
		var infowindow = new google.maps.InfoWindow({
			content: 'drag to locate'
		});
		var self = new google.maps.Marker({
			position: new google.maps.LatLng(40.71156, -73.95925),
			draggable: true,
			map: map,
			title: "you are here"
		});
		infowindow.open(map, self);
		self.addListener('click', function(e) {
			console.log(arguments);
		});
	}
});