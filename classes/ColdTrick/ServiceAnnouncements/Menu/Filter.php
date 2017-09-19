<?php

namespace ColdTrick\ServiceAnnouncements\Menu;

class Filter {
	
	/**
	 * Change the filter menu items on the service announcements page
	 *
	 * @param string          $hook         the name of the hook
	 * @param string          $type         the type of the hook
	 * @param \ElggMenuItem[] $return_value current return value
	 * @param array           $params       supplied params
	 *
	 * @return void|\ElggMenuItem[]
	 */
	public static function serviceAnnouncements($hook, $type, $return_value, $params) {
		
		if (!elgg_in_context('service_announcements')) {
			return;
		}
		
		// remove some items
		$remove_items = [
			'mine',
			'friend',
		];
		foreach ($return_value as $index => $menu_item) {
			if (!in_array($menu_item->getName(), $remove_items)) {
				continue;
			}
			
			unset($return_value[$index]);
		}
		
		// change 'all' text
		foreach ($return_value as $menu_item) {
			if ($menu_item->getName() !== 'all') {
				continue;
			}
			
			$menu_item->setText(elgg_echo('service_announcements:menu:filter:all'));
			break;
		}
		
		// add new item
		$return_value[] = \ElggMenuItem::factory([
			'name' => 'past',
			'text' => elgg_echo('service_announcements:menu:filter:past'),
			'href' => 'service_announcements/past',
			'priority' => 500,
		]);
		
		$return_value[] = \ElggMenuItem::factory([
			'name' => 'calendar',
			'text' => elgg_echo('service_announcements:menu:filter:calendar'),
			'href' => 'service_announcements/calendar',
			'priority' => 600,
		]);
		
		return $return_value;
	}
}
