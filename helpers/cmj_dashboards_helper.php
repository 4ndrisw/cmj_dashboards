<?php defined('BASEPATH') or exit('No direct script access allowed');


function cmj_dashboard_get_task_status($param)
{
	switch ($param) {
		case '5':
			$status = _l('task_status_5');
			break;
		case '4':
			$status = _l('task_status_4');
			break;
		case '3':
			$status = _l('task_status_3');
			break;
		case '2':
			$status = _l('task_status_2');
			break;
		case '1':
			$status = _l('task_status_1');
			break;
		
		default:
			$status = _l('undefined');
			break;
	}
	return $status;
}


hooks()->add_filter('before_get_project_statuses','cmj_dashboard_project_statuses');

function cmj_dashboard_project_statuses($current_statuses){
    // Push new status to the current statuses
    $current_statuses[] = array(
           'id'=>50, // new status with id 50
           'color'=>'#989898',
           'name'=>'Planning',
           'order'=>10,
           'filter_default'=>true, // true or false
        );
    // Return the statuses
    return $current_statuses;
}

hooks()->add_filter('before_get_task_statuses','cmj_dashboard_task_statuses');

function cmj_dashboard_task_statuses($current_statuses){
    // Push new status to the current statuses
    $current_statuses[] = array(
           'id'=>50, // new status with id 50
           'color'=>'#989898',
           'name'=>'Ready To Proposed',
           'order'=>10,
           'filter_default'=>true, // true or false
        );
    // Return the statuses
    return $current_statuses;
}