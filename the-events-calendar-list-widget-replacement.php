<?php
defined( 'ABSPATH' ) or exit;
/**
 * Plugin Name: The Events Calendar List Widget Replacement
 * Plugin URI: https://coreysalzano.com/wordpress/the-events-calendar-list-widget-replacement/
 * Description: When the Events List widget vanishes due to there being no upcoming events, this plugin outputs something else in its place. An add-on for The Events Calendar.
 * Version: 1.0.0
 * Author: Corey Salzano
 * Author URI: https://github.com/csalzano/the-events-calendar-list-widget-replacement
 * Text Domain: events-list-widget-replacement
 * Domain Path: /languages
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

add_action( 'tribe_events_widget_render', 'salzano_events_list_widget_replacement', 10, 3 );
function salzano_events_list_widget_replacement( $class, $widget_args, $widget_instance ) {

	//If the widget is not set to disappear when there are no events, do nothing
	if( ! isset( $widget_instance['no_upcoming_events'] ) || ! $widget_instance['no_upcoming_events'] ) {
		return;
	}

	/**
	 * Mimic a query in the widget to find out if there are any upcoming events.
	 * See line 131 of plugins/the-events-calendar/src/Tribe/List_Widget.php
	 */
	$posts = tribe_get_events(
		apply_filters(
			'tribe_events_list_widget_query_args', array(
				'eventDisplay'         => 'list',
				'posts_per_page'       => absint( $widget_instance['limit'] ),
				'is_tribe_widget'      => true,
				'tribe_render_context' => 'widget',
				'featured'             => empty( $widget_instance['featured_events_only'] ) ? false : (bool) $widget_instance['featured_events_only'],
			)
		)
	);

	if ( ! empty( $posts ) ) {
		return;
	}

	//If no events are found, show something in place of the widget.
	//The alternate content will live in this file if The Events Calendar PRO
	$pro_path = get_stylesheet_directory() . '/tribe-events/pro/widgets/list-widget-replacement.php';
	if( ! file_exists( $pro_path ) ) {

		//or here if we're running the free version of the plugin
		$free_path = str_replace( '/pro', '' , $pro_path );
		if( ! file_exists( $free_path ) ) {
			return;
		}

		include( $free_path );
		return;
	}

	include( $pro_path );
}
