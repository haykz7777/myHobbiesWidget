<?php 
/*
Plugin Name: My Hobbies
Plugin URI: 
Description: A widget to add your Favorite Hobbies to your site
Version: TBD
Author: TBD
*/

	// action hook
	add_action( 'widgets_init', 'hobbies_widget' );
	
	 // widget registration
	function hobbies_widget() {
	    register_widget( 'hobbies_list_widget' );
	 }

// main widget class 
class hobbies_list_widget extends WP_Widget {

    //constructor
    function hobbies_list_widget() {
        $widget_ops = array( 
			'classname' => 'hobbies_list_widget', 
			'description' => 'Show a list of favorite hobbies and a short description' 
			); 
        $this->WP_Widget( 'hobbies_list_widget', 'My Hobbies', $widget_ops );
    }
 
     //build the widget settings form
    function form($instance) {
        $defaults = array( 'title' => 'My Hobbies', 'hobby1' => '', 'hobby2' => '', 'hobby3' => '', 'description' => '' ); 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        $hobby1 = $instance['hobby1'];
        $hobby2 = $instance['hobby2'];
        $hobby3 = $instance['hobby3'];
        $description = $instance['description'];
        ?>
        
      <p> Title: <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>"  type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
      <p> First Hobby <input class="widefat" name="<?php echo $this->get_field_name( 'hobby1' ); ?>"  type="text" value="<?php echo esc_attr( $hobby1 ); ?>" /></p>
      <p> Second Hobby <input class="widefat" name="<?php echo $this->get_field_name( 'hobby2' ); ?>"  type="text" value="<?php echo esc_attr( $hobby2 ); ?>" /></p>
      <p> Third Hobby <input class="widefat" name="<?php echo $this->get_field_name( 'hobby3' ); ?>"  type="text" value="<?php echo esc_attr( $hobby3 ); ?>" /></p>
      <p>Description: <textarea class="widefat" name="<?php echo $this->get_field_name( 'description' ); ?>" / ><?php echo esc_attr( $description ); ?></textarea></p>
        <?php
    } // end function instance
 
    // function to handle the saving of widget's settings
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['hobby1'] = strip_tags( $new_instance['hobby1'] );
        $instance['hobby2'] = strip_tags( $new_instance['hobby2'] );
        $instance['hobby3'] = strip_tags( $new_instance['hobby3'] );
        $instance['description'] = strip_tags( $new_instance['description'] );
 
           return $instance;
    } // end function update
 
    // function to display the widget
    function widget($args, $instance) {
        extract($args);
 
        echo $before_widget;
        $title = apply_filters( 'widget_title', $instance['title'] );
        $hobby1 = empty( $instance['hobby1'] ) ? '&nbsp;' : $instance['hobby1'];
        $hobby2 = empty( $instance['hobby2'] ) ? '&nbsp;' : $instance['hobby2'];
        $hobby3 = empty( $instance['hobby3'] ) ? '&nbsp;' : $instance['hobby3'];
        $description = empty( $instance['description'] ) ? '&nbsp;' : $instance['description']; 
 
        echo $before_title . $title . $after_title;
        echo '<p>' . $hobby1 . '</p>';
        echo '<p>' . $hobby2 . '</p>';
        echo '<p>' . $hobby3 . '</p>';
        echo '<p><b>Why these hobbies?</b><br/> ' . $description . '</p>';
        echo $after_widget;
    } // end function widget 
}
?>