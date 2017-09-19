<?php

$start = strtotime(get_input('start')) ?: time();
$end = strtotime(get_input('end')) ?: time();

$dbprefix = elgg_get_config('dbprefix');
$startdate_name_id = elgg_get_metastring_id('startdate');
$enddate_name_id = elgg_get_metastring_id('enddate');

$options = [
	'type' => 'object',
	'subtype' => ServiceAnnouncement::SUBTYPE,
	'limit' => false,
	'joins' => [
		"JOIN {$dbprefix}metadata mdstart ON e.guid = mdstart.entity_guid",
		"JOIN {$dbprefix}metastrings msvstart ON mdstart.value_id = msvstart.id",
		"JOIN {$dbprefix}metadata mdend ON e.guid = mdend.entity_guid",
		"JOIN {$dbprefix}metastrings msvend ON mdend.value_id = msvend.id",
	],
	'wheres' => [
		"(
			mdstart.name_id = {$startdate_name_id}
			AND
			mdend.name_id = {$enddate_name_id}
			AND (
				(
					CAST(msvend.string AS SIGNED) > {$start}
					AND
					CAST(msvend.string AS SIGNED) < {$end}
				) OR (
					CAST(msvstart.string AS SIGNED) > {$start}
					AND
					CAST(msvstart.string AS SIGNED) < {$end}
				) OR (
					CAST(msvstart.string AS SIGNED) < {$start}
					AND
					(
						CAST(msvend.string AS SIGNED) = 0
						OR
						CAST(msvend.string AS SIGNED) > {$end}
					)
				)
			)
		)",
	],
];

$entities = elgg_get_entities_from_metadata($options);

$result = [];

foreach ($entities as $entity) {
	$result[] = [
		'title' => $entity->getDisplayName(),
		'start' => $entity->getStartDate(),
		'end' => $entity->getEndTimestamp() ? $entity->getEndDate() : gmdate('c', time()),
		'allDay' => $entity->isMultiDay(),
		'url' => $entity->getURL(),
		'className' => "service-announcements-announcement-type service-announcements-announcement-type-{$entity->announcement_type}",
	];
}

header('Content-type: application/json');

echo json_encode($result);
