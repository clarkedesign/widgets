<?php
/*
Plugin Name: Rounded Box Widget
Plugin URI: http://www.clarkedesign.co.uk/
Description: Sidebar widget to display a rounded box with content and title
Author: Clarke Website Design Lyd
Version: 1.0a
Author URI: http://www.clarkedesign.co.uk/
*/
 
 
class roundedboxwidget extends WP_Widget
{
  function roundedboxwidget()
  {
    $widget_ops = array('classname' => 'roundedboxwidget', 'description' => 'Displays a rounded box with title and content' );
    $this->WP_Widget('roundedboxwidget', 'Rounded Box and Title', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'content' => '' ) );
    
    $title   = $instance['title'];
    $content = $instance['content'];
?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  
    <p><label for="<?php echo $this->get_field_id('content'); ?>">Content: </label></p>
    
    <textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" cols="20" rows="16"><?php echo attribute_escape($content); ?></textarea>
    
    
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    
    // Retrieve Fields
    $instance['title']   = strip_tags($new_instance['title']);
    $instance['content'] = strip_tags($new_instance['content']);
    
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title   = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $content = $instance['content'];
 
    if (!empty($title))
       echo $before_title . $title . $after_title;
      
    if (!empty($content))       
       echo '<p class="rbw-content">'.$content.'</p>';
 
    echo $after_widget;
  }
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("roundedboxwidget");') );


function rbw_scripts() {
  wp_enqueue_style( "rbw_css", path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/rbw-styles.css"));
}    
 
add_action('wp_enqueue_scripts', 'rbw_scripts');

?>
