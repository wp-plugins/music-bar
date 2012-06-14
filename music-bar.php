
<?php
/*
Plugin Name: Music Control widget
Plugin URI: http://bumbablog.com/
Description: Controla la barra de música
Version: 1.0
Author: dlozano
Author URI: http://bumbablog.com/
*/

add_action('widgets_init', 'fb_load_widgets');

function fb_load_widgets() {
    register_widget( 'Fbrelatedpost_Widget' );
}

class Fbrelatedpost_Widget extends WP_Widget {

    function Fbrelatedpost_Widget() {
        /* Widget settings. */
        $widget_ops     = array( 'classname' => 'fbrelatedpost', 'description' => __('Controla la barra de música.', 'Related post') );

        /* Widget control settings. */
        $control_ops    = array( 'width' => 300, 'height' => 350, 'id_base' => 'related-post-widget' );

        /* Create the widget. */
        $this->WP_Widget( 'related-post-widget', __('Music Control Widget', 'Related post'), $widget_ops, $control_ops );
    }


    function widget( $args, $instance ) {
        extract( $args );

        
            global $post;

            $title              = apply_filters('widget_title', $instance['title'] );
            $number_of_post     = $instance['fb_number_posts'];
			$archive_html       = $instance['archive_html'];
            
            $myposts    = get_posts('numberposts=' . $number_of_post . '&category=' . $cat);

            echo $before_widget;
           
			
			?>
 
<SCRIPT LANGUAGE="JavaScript">
    <!--
function iniciar()
{
    var boton = document.getElementById("boton");
    boton.disabled = true;
          
    if (top != self) {
      parent.bottomFrame.location = "http://bumbablog.com/radio/rock-clasico";
boton.disabled = false;
    }

    else{     
      
      
      boton.disabled = false;
    }
}


function desactivar()
{
    var boton = document.getElementById("boton_de");
    boton.disabled = true;
      
    if (top != self) {
      top.location.href = location.href;
    }

    else{     
       boton.disabled = false;
    }
}

function ampliar()
{
    var boton = document.getElementById("boton_am");
    boton.disabled = true;
  
    var frame = parent.document.getElementById("padre");
    frame.rows = "*,194";

    boton.disabled =false;
}

function abrir()
{
    var boton = document.getElementById("boton_ab");
    boton.disabled = true;
  
    var frame = parent.document.getElementById("padre");
    frame.rows = "*,84";

   boton.disabled = false;

}

function cerrar()
{
    var boton = document.getElementById("boton_ce");
    boton.disabled = true;
  
    var frame = parent.document.getElementById("padre");
    frame.rows = "100%,*";

   boton.disabled = false;

}
   // -->
</SCRIPT>                 
<div style="background: #000000; padding: 2px"><a style ="color:#666666; font-size: 8px;" href="http://bumbablog.com" target="_blank">BUMBABlog</a></div>
<div style="padding:3px; background: #333333; height:83px">           
<div style="margin-bottom:3px; height:35px; background:#000000; color:#ffffff; cursor: pointer;  text-align:center; font-size:medium; padding-top:20px;" id="boton" name="boton" onClick="iniciar()">Play - <?php echo $instance['title']; ?></div>

<div style="float: left; width:25%; height:22px; background:#000000; color:#ffffff; cursor: pointer;  text-align:center; font-size:normal; padding-top:3px;" id="boton_ce" name="boton_ce" onClick="cerrar()"><p>—</p></div>

<div style="float: left;  width:25%; height:20px; background:#111111; color:#ffffff; cursor: pointer;  text-align:center; font-size:normal; padding-top:5px;" id="boton_ab" name="boton_ab" onClick="abrir()"><b>Bar</b></div>

<div style="float: left;  width:25%; height:20px; background:#000000; color:#ffffff; cursor: pointer;  text-align:center; font-size:normal; padding-top:5px;" id="boton_am" name="boton_am" onClick="ampliar()"><b>List</b></div>

<div style="float: right;  width:25%; height:20px; background:#111111; color:#ffffff; cursor: pointer;  text-align:center; font-size:normal; padding-top:5px;" id="boton_de" name="boton_de" onClick="desactivar()"><b>X</b></div>

</div>            
            
            
            
            <?php
			
			
			 echo $after_widget;
    
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['archive_html'] = $new_instance['archive_html'];
        $instance['fb_number_posts'] = $new_instance['fb_number_posts'];

        return $instance;
    }

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults   = array( 'title' => __('Title Bar', 'hybrid'), 'fb_number_posts' => __('Archive php', 'fbrelatedpost'), 'archive_html' => __('Archive html', 'fb_archive_html'));
        $instance   = wp_parse_args( (array) $instance, $defaults );

        echo <<<ST1
        <p>
            <label for='{$this->get_field_id('title')}'>Title bar:</label>
            <input type='text' value='{$instance['title']}' name='{$this->get_field_name('title')}' id='{$this->get_field_id('title')}' class='widefat'>
        </p>
       
		
		
ST1;

    }


}
?>

     