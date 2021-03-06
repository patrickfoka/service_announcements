define(function(require){
	var $ = require('jquery');
	var elgg = require('elgg');
	
	var submit_form = function() {
		
		if ($(this).find('select[name="priority"]').val() === 'critical') {
			// make sure user is ready for added features
			if (!confirm(elgg.echo('service_announcements:priority:critical:confirm'))) {
				return false;
			}
		}
		
		if (!$(this).find('input[type="checkbox"][name="services[]"]:checked').length) {
			if (!confirm(elgg.echo('service_announcements:service_announcements:edit:services:confirm'))) {
				return false;
			}
		}
		
		return true;
	};
	
	$(document).on('submit', 'form.elgg-form-service-announcements-edit', submit_form);
});
