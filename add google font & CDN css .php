Add CSS from directory file
===========================
Code::::

<?php 
	function /*function name*/(){
		//style register 
		wp_register_style('$handle', '$src', '$depends'array(), '$ver', '$media');
		/*---------------------------------------------------------------------------------------------------------
		description: $handle mean handle just a name according to files. Which name include in wp_enqueue_style
		$src mean source. Which files include.
		$deps mean depends. That means this files depends on other files. if true use array('file name'), else use default array()
		$ver mean version. css file version include. like, for custom css ver 1.0
		$media we include 'all'
		----------------------------------------------------------------------------------------------------------*/
		
		
		//style enqueue
		wp_enqueue_style('$handle');
	}
	
	add_action('wp_enqueue_scripts','//function name');
?>

Example::::

<?php 
	function add_style_files(){
		//style register 
		wp_register_style( 'style_css', get_template_directory_uri() .'/style.css', array(), '1.0', 'all' ); 
		
		//style enqueue
		wp_enqueue_style('style_css');
	}
	
	add_action('wp_enqueue_scripts','add_style_files');
?>



Add CSS files from online CDN
=========================
Code::::

<?php 
	function /*function name*/(){
		//style register 
		wp_register_style('$handle', '$src', '$depends'array() );
		
		//style enqueue
		wp_enqueue_style('$handle');
	}
	
	add_action('wp_enqueue_scripts','//function name');
?>

Example::::

<?php 
	function add_style_files(){
		//style register 
		wp_register_style('bootstrap', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', false);
		
		//style enqueue
		wp_enqueue_style('bootstrap');
	}
	
	add_action('wp_enqueue_scripts','add_style_files');
?>


Add google font
=================
Code::::
<!--add google font code require-->
<?php
	//add google fonts
	function /*function name*/(){
		//style register 
		wp_register_style('$handle','$src','$deps'array());
		
		
		//style enqueue
		wp_enqueue_style('$handle');
	}
	
	add_action('wp_enqueue_scripts','//function name');
?>

Example::::
<!--add google font code example-->
<?php
	//add google fonts
	function add_google_fonts(){
		//style register 
		wp_register_style('roboto_font','http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300',false);
		
		//style enqueue
		wp_enqueue_style('roboto_font');
	}
	
	add_action('wp_enqueue_scripts','add_google_fonts');
?>