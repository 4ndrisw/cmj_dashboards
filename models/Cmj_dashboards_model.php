<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Cmj_dashboards_model extends App_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Get unique sale agent for schedules / Used for filters
     * @return array
     */
    public function staff_with_statuses()
    {
	$query = $this->db->query("SELECT `staff`.`staffid` AS `staff_id`, 
							   CONCAT( `staff`.`firstname`, ' ', `staff`.`lastname` ) AS `staff_fullname`,
							   SUM( CASE WHEN `tasks`.`status` = 1 THEN 1 ELSE 0 END ) AS `task_status_1`,
							   SUM( CASE WHEN `tasks`.`status` = 2 THEN 1 ELSE 0 END ) AS `task_status_2`,
							   SUM( CASE WHEN `tasks`.`status` = 3 THEN 1 ELSE 0 END ) AS `task_status_3`,
							   SUM( CASE WHEN `tasks`.`status` = 4 THEN 1 ELSE 0 END ) AS `task_status_4` 
							   FROM `tbltasks` AS `tasks`
							   LEFT JOIN `tbltask_assigned` AS `assigned` ON `assigned`.`taskid` = `tasks`.`id`
							   LEFT JOIN `tblstaff` AS `staff` ON `assigned`.`staffid` = `staff`.`staffid`
							   GROUP BY `staff`.`staffid`");

	return $query->result();
    }

}