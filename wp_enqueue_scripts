/**
 * Enqueue scripts and styles.
 **/
function add_styles(){
    wp_enqueue_style('bootstrap-style', get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), '4.1.3', 'all');
    wp_enqueue_style('fontawesome-style', get_template_directory_uri().'/assets/css/font-awesome.min.css', array(), '4.7.0', 'all');
    wp_enqueue_style('acumin-style', get_template_directory_uri().'/assets/css/acumin.css', array(), '1.0.0', 'all');
    wp_enqueue_style('compass-style', get_stylesheet_uri(), '', '1.0');
    wp_enqueue_style('responsive-style', get_template_directory_uri().'/assets/css/responsive.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'add_styles');

function add_scripts(){
    wp_enqueue_script('bootstrap-srcipt', get_template_directory_uri().'/assets/js/bootstrap.bundle.min.js', array(), '4.1.3', true);
    wp_enqueue_script('scroll-srcipt', 'https://unpkg.com/scrollreveal', array(), '4.0.9', true);
    if(is_page_template('templates/careers.php')){
        wp_enqueue_script('greenhouse-srcipt', 'https://boards.greenhouse.io/embed/job_board/js?for=ncc', array(), '1.0.0', true);
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-srcipt', get_template_directory_uri().'/assets/js/custom.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'add_scripts');
