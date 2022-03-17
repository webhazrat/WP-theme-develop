<?php
/*
    Get users of wordpress
    ## get_users(1)
        1. role, role__in(array)
*/
$users = get_users(array("role" => "Author")); ?>
<select name="users">
<?php
foreach($users as $index=>$user){ ?>
    <option value="<?php echo $user->data->ID; ?>"><?php echo $user->data->display_name; ?></option>
<?php } ?>
</select>


<?php 
/*
    Get all pages
    
*/


?>