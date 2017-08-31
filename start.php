<?php
/**
 * Main plugin file
 */

define('SERVICE_ANNOUNCEMENT_STAFF', 'service_announcement_staff');

require_once(dirname(__FILE__) . '/lib/functions.php');

// register default elgg events
elgg_register_event_handler('init', 'system', 'service_announcements_init');

/**
 * Init function for this plugin
 *
 * @return void
 */
function service_announcements_init() {
	
	// css/js
	elgg_extend_view('elgg.css', 'css/service_announcements/site.css');
	
	// ajax
	elgg_register_ajax_view('service_announcements/service_announcement/status_update');
	
	// register page handlers
	elgg_register_page_handler('services', '\ColdTrick\ServiceAnnouncements\Router::services');
	elgg_register_page_handler('service_announcements', '\ColdTrick\ServiceAnnouncements\Router::serviceAnnouncements');
	
	// events
	elgg_register_event_handler('update:after', 'object', '\ColdTrick\ServiceAnnouncements\Access::updateAnnotationAccess');
	
	// plugin hooks
	elgg_register_plugin_hook_handler('container_permissions_check', 'object', '\ColdTrick\ServiceAnnouncements\Permissions::serviceContainerPermissions');
	elgg_register_plugin_hook_handler('container_permissions_check', 'object', '\ColdTrick\ServiceAnnouncements\Permissions::serviceAnnouncementContainerPermissions');
	elgg_register_plugin_hook_handler('permissions_check', 'object', '\ColdTrick\ServiceAnnouncements\Permissions::servicePermissions');
	elgg_register_plugin_hook_handler('permissions_check', 'object', '\ColdTrick\ServiceAnnouncements\Permissions::serviceAnnouncementPermissions');
	
	elgg_register_plugin_hook_handler('register', 'menu:site', '\ColdTrick\ServiceAnnouncements\Menu\Site::registerServiceAnnouncements');
	elgg_register_plugin_hook_handler('register', 'menu:page', '\ColdTrick\ServiceAnnouncements\Menu\Page::registerServices');
	elgg_register_plugin_hook_handler('register', 'menu:page', '\ColdTrick\ServiceAnnouncements\Menu\Page::registerServiceAnnouncements');
	elgg_register_plugin_hook_handler('register', 'menu:annotation', '\ColdTrick\ServiceAnnouncements\Menu\Annotation::registerDelete');
	elgg_register_plugin_hook_handler('register', 'menu:filter', '\ColdTrick\ServiceAnnouncements\Menu\Filter::serviceAnnouncements');
	elgg_register_plugin_hook_handler('register', 'menu:filter', '\ColdTrick\ServiceAnnouncements\Menu\Filter::serviceAnnouncementsStaff');
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', '\ColdTrick\ServiceAnnouncements\Menu\UserHover::registerStaff');
	
	// register actions
	elgg_register_action('services/edit', dirname(__FILE__) . '/actions/services/edit.php');
	elgg_register_action('services/delete', dirname(__FILE__) . '/actions/services/delete.php');
	
	elgg_register_action('service_announcements/edit', dirname(__FILE__) . '/actions/service_announcements/edit.php');
	elgg_register_action('service_announcements/delete', dirname(__FILE__) . '/actions/service_announcements/delete.php');
	elgg_register_action('service_announcements/status_update', dirname(__FILE__) . '/actions/service_announcements/status_update.php');
	elgg_register_action('service_announcements/status_update_delete', dirname(__FILE__) . '/actions/service_announcements/status_update_delete.php');
	
	elgg_register_action('service_announcements/admin/toggle_staff', dirname(__FILE__) . '/actions/service_announcements/admin/toggle_staff.php', 'admin');
}
