<?php
/**
 * Add/edit a ServiceAnnouncements
 *
 * @uses $vars['entity'] the ServiceAnnouncement to edit
 */

elgg_require_js('forms/service_announcements/edit');

/* @var $entity ServiceAnnouncement */
$entity = elgg_extract('entity', $vars);

if ($entity instanceof ServiceAnnouncement) {
	echo elgg_view_field([
		'#type' => 'hidden',
		'name' => 'guid',
		'value' => $entity->guid,
	]);
}

// title
echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('title'),
	'name' => 'title',
	'value' => elgg_extract('title', $vars),
	'required' => true,
]);

// description
echo elgg_view_field([
	'#type' => 'longtext',
	'#label' => elgg_echo('description'),
	'name' => 'description',
	'value' => elgg_extract('description', $vars),
]);

// tags
echo elgg_view_field([
	'#type' => 'tags',
	'#label' => elgg_echo('tags'),
	'name' => 'tags',
	'value' => elgg_extract('tags', $vars),
]);

// services
echo elgg_view_field([
	'#type' => 'services',
	'#label' => elgg_echo('service_announcements:service_announcements:edit:services'),
	'#help' => elgg_echo('service_announcements:service_announcements:edit:services:help'),
	'name' => 'services',
	'value' => elgg_extract('services', $vars),
]);

// start date
echo elgg_view_field([
	'#type' => 'sa_datetimepicker',
	'#label' => elgg_echo('service_announcements:service_announcements:startdate'),
	'name' => 'startdate',
	'value' => elgg_extract('startdate', $vars),
	'timestamp' => true,
	'required' => true,
]);

// end date
echo elgg_view_field([
	'#type' => 'sa_datetimepicker',
	'#label' => elgg_echo('service_announcements:service_announcements:enddate'),
	'name' => 'enddate',
	'value' => elgg_extract('enddate', $vars),
	'timestamp' => true,
]);

echo elgg_view_field([
	'#type' => 'userpicker',
	'#label' => elgg_echo('service_announcements:contact_user'),
	'#help' => elgg_echo('service_announcements:contact_user:help'),
	'name' => 'contact_user',
	'values' => elgg_extract('contact_user', $vars),
]);

// announcement type
echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('service_announcements:announcement_type'),
	'name' => 'announcement_type',
	'value' => elgg_extract('announcement_type', $vars),
	'options_values' => [
		'maintenance' => elgg_echo('service_announcements:announcement_type:maintenance'),
		'incident' => elgg_echo('service_announcements:announcement_type:incident'),
	],
]);

// priority
echo elgg_view_field([
	'#type' => 'priority',
	'#label' => elgg_echo('service_announcements:priority'),
	'name' => 'priority',
	'value' => elgg_extract('priority', $vars),
]);

// access
echo elgg_view_field([
	'#type' => 'access',
	'#label' => elgg_echo('access'),
	'name' => 'access_id',
	'value' => (int) elgg_extract('access_id', $vars),
	'entity_type' => 'object',
	'entity_subtype' => ServiceAnnouncement::SUBTYPE,
	'container_guid' => elgg_get_site_entity()->guid,
	'entity' => $entity,
]);

// footer
$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);

elgg_set_form_footer($footer);
