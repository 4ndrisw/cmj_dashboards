<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php

$tasks = [];
$this->db->where('status !=', 5);
$tasks = $this->db->get('tbltasks')->result();

$query = $this->db->query("SELECT `clients`.`userid` AS `client_id`,`clients`.`company`,`projects`.`id` AS `project_id`,`projects`.`name` AS `project_name`, COUNT(`tasks`.`id`) AS `uncomplete_tasks`,`projects`.`deadline` AS `project_deadline`, datediff(`projects`.`deadline`, NOW()) AS `project_overdue` FROM `tbltasks` AS `tasks`
join `tblprojects` AS `projects` ON `projects`.`id` =  `tasks`.`rel_id`
join `tblclients`AS `clients` ON `clients`.`userid` = `projects`.`clientid` 
where `tasks`.`rel_type`='project' AND `tasks`.`status`<>'5' AND `projects`.`status`<>'5'
GROUP BY `project_name`
ORDER BY `projects`.`deadline` ASC");

$widget_data = $query->result();

?>


<div class="widget" id="widget-<?php echo create_widget_id(); ?>" data-name="<?php echo _l('clients_task_recapitulation'); ?>">
  <div class="">
    <div class="panel_s">
      <div class="panel-body">
        <div class="widget-dragger"></div>
        <h4 class="pull-left mtop5"><?php echo _l('clients_task_recapitulation'); ?></h4>
        <div class="clearfix"></div>
        <div class="row mtop5">
          <hr class="hr-panel-heading-dashboard">
        </div>
        <table id="widget-<?php echo create_widget_id(); ?>" class="table dt-table" data-order-col="3" data-order-type="asc">
          <thead>
            <th class="company"><?= _l('company') ?></th>
            <th class="project_name"><?= _l('project_name') ?></th>
            <th class="uncomplete_tasks"><?= _l('uncomplete_tasks') ?></th>
            <th class="project_deadline"><?= _l('project_deadline') ?></th>
          </thead>
          <tbody>

            <?php if (count($widget_data) > 0) { ?>
              <?php $overdue = ''; ?>
              <?php foreach ($widget_data as $widget_row) { ?>
                <?php 
                  if ($widget_row->project_overdue <= 0) {
                    $overdue = 'overdue';}else{
                    $overdue = '';}
                 ?>
                <tr class="<?= $overdue .' day'.$widget_row->project_overdue. ' client-'.$widget_row->client_id .' project-'. $widget_row->project_id ?>">
                  <td class="company"><a target="_blank" href="<?= admin_url('clients/client/' . $widget_row->client_id) ?>"><?= $widget_row->company ?></a></td>
                  <td class="project_name"><a target="_blank" href="<?= admin_url('projects/view/' . $widget_row->project_id) ?>"><?= $widget_row->project_name ?></a></td>
                  <td class="uncomplete_tasks ml-4"><?= $widget_row->uncomplete_tasks ?></td>
                  <td class="project_deadline"><?= $widget_row->project_deadline ?></td>
                </tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td colspan="7"><?= _l('not_found') ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>