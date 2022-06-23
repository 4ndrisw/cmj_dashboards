<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: CMJ Dashboards
Description: Mdule for defining CMJ Dashboards
Version: 1.0.2
Requires at least: 2.2.*
*/


if (!defined('MODULE_CMJ_DASHBOARDS')) {
    define('MODULE_CMJ_DASHBOARDS', basename(__DIR__));
}

define('CMJ_DASHBOARDS_MODULE_NAME', 'cmj_dashboards');
define('CMJ_DASHBOARDS_ASSETS_PATH', 'modules/cmj_dashboards/assets');

/**
* Register activation module hook
*/
register_activation_hook(CMJ_DASHBOARDS_MODULE_NAME, 'cmj_dashboards_module_activation_hook');

function cmj_dashboards_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**
* Register language files, must be registered if the module is using languages
*/
register_language_files(CMJ_DASHBOARDS_MODULE_NAME, [CMJ_DASHBOARDS_MODULE_NAME]);


/*
hooks()->add_action('after_cron_run', 'cmj_dashboards_notification');
hooks()->add_action('admin_init', 'cmj_dashboards_module_init_menu_items');
hooks()->add_action('staff_member_deleted', 'cmj_dashboards_staff_member_deleted');
hooks()->add_action('admin_init', 'cmj_dashboards_permissions');

hooks()->add_filter('migration_tables_to_replace_old_links', 'cmj_dashboards_migration_tables_to_replace_old_links');
hooks()->add_filter('global_search_result_query', 'cmj_dashboards_global_search_result_query', 10, 3);
hooks()->add_filter('global_search_result_output', 'cmj_dashboards_global_search_result_output', 10, 2);
*/

hooks()->add_filter('get_dashboard_widgets', 'cmj_dashboards_add_dashboard_widget');

function cmj_dashboards_add_dashboard_widget($widgets)
{
    
    $widgets[] = [
        'path'      => 'cmj_dashboards/widgets/staff_with_statuses',
        'container' => 'left-8',
    ];
    
    $widgets[] = [
        'path'      => 'cmj_dashboards/widgets/tasks_not_assigned',
        'container' => 'right-4',
    ];
    $widgets[] = [
        'path'      => 'cmj_dashboards/widgets/completed_tasks_no_file',
        'container' => 'left-8',
    ];

    $widgets[] = [
        'path'      => 'cmj_dashboards/widgets/projects_have_no_tasks',
        'container' => 'right-4',
    ];

    $widgets[] = [
        'path'      => 'cmj_dashboards/widgets/clients_task_recapitulation',
        'container' => 'left-8',
    ];

    return $widgets;
}



$CI = &get_instance();
$CI->load->helper(CMJ_DASHBOARDS_MODULE_NAME . '/cmj_dashboards');

if (!file_exists(APP_MODULES_PATH.MODULE_CMJ_DASHBOARDS.'/assets/js')) {
    mkdir(APP_MODULES_PATH.MODULE_CMJ_DASHBOARDS.'/assets/js',0755,true);
    file_put_contents(APP_MODULES_PATH.MODULE_CMJ_DASHBOARDS.'/assets/js/'.MODULE_CMJ_DASHBOARDS.'.js', '');
}
//  auto create custom css file
if (!file_exists(APP_MODULES_PATH.MODULE_CMJ_DASHBOARDS.'/assets/css')) {
    mkdir(APP_MODULES_PATH.MODULE_CMJ_DASHBOARDS.'/assets/css',0755,true);
    file_put_contents(APP_MODULES_PATH.MODULE_CMJ_DASHBOARDS.'/assets/css/'.MODULE_CMJ_DASHBOARDS.'.css', '');
}
$CI->app_css->add(MODULE_CMJ_DASHBOARDS.'-css', base_url('modules/'.MODULE_CMJ_DASHBOARDS.'/assets/css/'.MODULE_CMJ_DASHBOARDS.'.css'));
$CI->app_scripts->add(MODULE_CMJ_DASHBOARDS.'-js', base_url('modules/'.MODULE_CMJ_DASHBOARDS.'/assets/js/'.MODULE_CMJ_DASHBOARDS.'.js'));
