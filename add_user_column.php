<?php

/*
 * Add new column to users table in admin panel
 * */

function test_modify_user_table($column){

    $column['phone'] = 'Phone';
    return $column;
}

function test_sortable_column($columns){
    
    $columns['phone'] = 'Phone';

    return $columns;
}

function test_modify_user_table_row($val, $column_name, $user_id){

    if ($column_name == 'phone') {
        return get_user_meta($user_id, 'phone', true);
    }
    return $val;
}

function test_user_query($userquery){
    if('phone'==$userquery->query_vars['orderby']) {//check if church is the column being sorted
        global $wpdb;
        $userquery->query_from .= " LEFT OUTER JOIN $wpdb->usermeta AS alias ON ($wpdb->users.ID = alias.user_id) ";//note use of alias
        $userquery->query_where .= " AND alias.meta_key = 'phone' ";//which meta are we sorting with?
        $userquery->query_orderby = " ORDER BY alias.meta_value ".($userquery->query_vars["order"] == "ASC" ? "asc " : "desc ");//set sort order
    }
}


//Add heading at the top

// Not sortable
add_filter('manage_users_columns', 'test_modify_user_table');

// Sortable
add_filter( 'manage_users_sortable_columns', 'test_sortable_column' );

// Value in this column
add_filter('manage_users_custom_column', 'test_modify_user_table_row', 10, 3);

// Users sorting in case of sortable column
add_action('pre_user_query','test_user_query',10,1);