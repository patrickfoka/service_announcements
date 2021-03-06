<?php

namespace ColdTrick\ServiceAnnouncements;

class Widgets {
	
	/**
	 * Register the service_announcements widget
	 *
	 * @param string                   $hook         the name of the hook
	 * @param string                   $type         the type of the hook
	 * @param \Elgg\WidgetDefinition[] $return_value current return value
	 * @param array                    $params       supplied params
	 *
	 * @return \Elgg\WidgetDefinition[]
	 */
	public static function registerServiceAnnouncementsWidget($hook, $type, $return_value, $params) {
		
		$return_value[] = \Elgg\WidgetDefinition::factory([
			'id' => 'service_announcements',
			'context' => [
				'index',
				'profile',
				'dashboard',
				'groups',
			],
			'multiple' => true,
		]);
		
		return $return_value;
	}
}
