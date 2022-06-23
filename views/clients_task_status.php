<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$tasks = [];
$this->load->model('tasks_model');
$tasks = $this->tasks_model->get_billable_tasks();

$query = $this->db->query("SELECT `clients`.`userid` AS `client_id`,`clients`.`company`,`projects`.`id` AS `project_id`, `projects`.`name` AS `project_name`,`tasks`.`id` AS `task_id`,`tasks`.`name` AS `task_name`,`tasks`.`status` FROM `tbltasks` AS `tasks`
join `tblprojects` AS `projects` ON `projects`.`id` =  `tasks`.`rel_id`
join `tblclients`AS `clients` ON `clients`.`userid` = `projects`.`clientid` 
where `tasks`.`rel_type`='project' AND `tasks`.`status`<>5");



$widget_data = $query->result();

$compiled_select = $this->db->get_compiled_select();

?>


<div class="widget<?php if(count($tasks) == 0){echo ' hide';} ?>" id="widget-<?php echo create_widget_id('clients_task_status'); ?>">


  <div class="">
    <div class="panel_s">
      <div class="panel-body">
        <div class="widget-dragger"></div>

        <h4 class="pull-left mtop5"><?php echo _l('clients_task_statuses'); ?></h4>
        <div class="clearfix"></div>
        <div class="row mtop5">
          <hr class="hr-panel-heading-dashboard">
        </div>
        <table class="table dataTable no-footer dtr-inline">
          <thead>
            <th><?= _l('company') ?></th>
            <th><?= _l('project_name') ?></th>
            <th><?= _l('task_name') ?></th>
            <th><?= _l('status') ?></th>
          </thead>
          <tbody>
            <?php if (count($widget_data) > 0) { ?>
              <?php foreach ($widget_data as $widget_row) { ?>
                <tr>
                  <td><a target="_blank" href="<?= admin_url('clients/client/' . $widget_row->client_id) ?>"><?= $widget_row->company ?></a></td>
                  <td><a target="_blank" href="<?= admin_url('projects/view/' . $widget_row->project_id) ?>"><?= $widget_row->project_name ?></a></td>
                  <td><a target="_blank" href="<?= admin_url('tasks/view/' . $widget_row->task_id) ?>"><?= $widget_row->task_name ?></a></td>
                  <td><?= cmj_dashboard_get_task_status($widget_row->status) ?></td>
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