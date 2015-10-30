<?php
/*
Plugin Name: I Am Real Donald Trump Widget
Plugin URI: http://github.com/jennschiffer/i-am-real-donald-trump-widget
Description: A widget that allows you to be Donald Trump.
Version: 1.0
Author: Jenn Schiffer
Author URI: http://jennmoney.biz

Copyright 2015  Jenn Schiffer  (http://jennmoney.biz)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

add_action('widgets_init', 'i_am_real_donald_trump_widget_init', 1);
function i_am_real_donald_trump_widget_init() {
  register_widget('I_Am_Real_Donald_Trump_Widget');
  load_plugin_textdomain('i-am-real-donald-trump-widget', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action('wp_head', 'i_am_real_donald_trump_widget_css');
function i_am_real_donald_trump_widget_css() {
  echo '<style type="text/css"></style>';
}

class I_Am_Real_Donald_Trump_Widget extends WP_Widget {

  public function __construct() {
    $widget_ops = array('classname' => 'i_am_real_donald_trump_widget', 'description' => __('Enter your twitter handle and become Real Donald Trump','i-am-real-donald-trump-widget'));
    parent::__construct('i-am-real-donald-trump-widget', __('I Am Real Donald Trump'), $widget_ops);
  }

  public function widget($args, $instance) {
    extract($args);
    $twitterHandle = apply_filters( 'widget_twitterHandle', empty($instance['twitterHandle']) ? '' : $instance['twitterHandle'], $instance, $this->id_base);
    
    // no title right now
    echo $before_widget . $before_title  . $after_title; 
 
    // for each item in comment array, display tweet
    if ($twitterHandle) {
      echo '<div class="i-am-real-donald-trump-twitter-handle">' . $twitterHandle . '</div>'; 
    }

    echo $after_widget;
  }

  public function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'twitterHandle' => '') );
    $twitterHandle = strip_tags($instance['twitterHandle']);

    echo '<p>' .
          '<label for="' . $this->get_field_id('twitterHandle') . '">' . __('Your Twitter Handle','i-am-real-donald-trump-widget') . ': ' . 
          '<input class="widefat" id="' . $this->get_field_id('twitterHandle') .'" name="' . $this->get_field_name('twitterHandle') .'" type="text" value="' . esc_attr($twitterHandle) . '" placeholder="realDonaldTrump" /></label>' . 
         '</p>';
  }
  
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['twitterHandle'] = strip_tags($new_instance['twitterHandle']);
    return $instance;
  }
  
}
