<?php

// lang
language_attributes();

// bloginfo
bloginfo( 'charset' ); //meta character set
bloginfo( 'name' ); // Display the Site Title
bloginfo( 'description' ); // Display the Tagline
bloginfo( 'url' ); // Display the Site Address/URL
bloginfo( 'language' ); // Display the language
bloginfo( 'stylesheet_directory' ); //Displays the primary CSS (usually style.css) file URL of the active theme

// custom logo
add_theme_support('custom-logo'); // We have to support custom logo to functions.php before call the_custom_logo() function.
the_custom_logo(); // Displays a custom logo, linked to home unless the theme supports removing the link on the home page.


get_stylesheet_directory_uri();
get_template_directory_uri();
get_template_directory();

wp_head(); // Prints scripts or data in the head tag on the front end.
wp_footer(); // Prints scripts or data before the closing body tag on the front end.
body_class(); // This function gives the body element different classes and can be added


// Conditional functions
has_custom_logo(); // Determines whether the site has a custom logo.
is_home(); // Determines whether the query is for the blog homepage.
is_front_page(); // Determines whether the query is for the front page of the site.
is_admin(); // Determines whether the current request is for an administrative interface page.
is_page(int|string|int[]|string[] $page = ''); // Determines whether the query is for an existing single page.
is_single( int|string|int[]|string[] $post = '' ); // Determines whether the query is for an existing single post.