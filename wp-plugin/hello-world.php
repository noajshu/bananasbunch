<?php
/*
Plugin Name: Weeb-Hello-World
Plugin URI: http://weebtutorials..com/
Description: A hello world plugin used to demonstrate the process of creating plugins.
Version: 1.0
Author: John Richardson
Author URI: http://weebtutorials.com
License: GPL
*/

//Hooks a function to a filter action, 'the_content' being the action, 'hello_world' the function.
// add_filter('the_content','hello_world');

// //Callback function
// function hello_world($content)
// {

// 	//Checking if on post page.
// 	if ( is_single() ) {
// 		//Adding custom content to end of post.
// 		return $content . "<h1 style=\"color:#eb911d\"> Hello World </h1>";
// 	}
// 	else {
// 		//else on blog page / home page etc, just return content as usual.
// 		return $content;
// 	}
// }

function my_cron_schedules($schedules){
    if(!isset($schedules["5min"])){
        $schedules["5min"] = array(
            'interval' => 5*60,
            'display' => __('Once every 5 minutes'));
    }
    if(!isset($schedules["30min"])){
        $schedules["30min"] = array(
            'interval' => 30*60,
            'display' => __('Once every 30 minutes'));
    }
    return $schedules;
}
add_filter('cron_schedules','my_cron_schedules');

register_activation_hook(__FILE__, 'my_activation');

function my_activation() {
    if (! wp_next_scheduled ( 'my_recurring_event' )) {
		wp_schedule_event(time(), '5min', 'my_recurring_event');
    }
}

add_action('my_recurring_event', 'do_this_on_event');

function do_this_on_event() {
	// do something every time the recurring event hits
	$response = file_get_contents("http://curl.to/noajshu/hello+every+5min+from+bananas");
}

register_deactivation_hook(__FILE__, 'my_deactivation');

function my_deactivation() {
	wp_clear_scheduled_hook('my_recurring_event');
}

?>