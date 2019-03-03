# The Events Calendar List Widget Replacement

When the Events List widget vanishes due to there being no upcoming events, this plugin outputs something else in its place. An add-on for The Events Calendar.

The Events Calendar by Modern Tribe ships with a widget called Events List. Inside, there is a setting to hide the widget totally when there are no upcoming events to display in the list. This plugin detects this setting, predicts the absence of events, and outputs some other content of your choosing instead.

## Instructions

Create a file at `wp-content/themes/your-theme/tribe-events/pro/widgets/list-widget-replacement.php` that contains the content you wish to display in place of the Events List widget when there are no upcoming events.

If you're using the free version of The Events Calendar, create the file at `wp-content/themes/your-theme/tribe-events/widgets/list-widget-replacement.php`