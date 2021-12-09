<?php
//for get header template
get_header(string name, array $args = array());
// name parameter user for load specific header template.
//echo $args['key'];

//for get footer template
get_footer(string name, array $args = array());

//for have posts
have_posts(); //if have posts return true else false
