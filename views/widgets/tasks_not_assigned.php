<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php

$query = $this->db->query("SELECT `tasks`.`id`,`tasks`.`name` FROM `tbltasks` AS `tasks` LEFT JOIN `tbltask_assigned` AS `assigned` ON `assigned`.`taskid`=`tasks`.`id` WHERE `assigned`.`taskid`IS NULL");

$widget_data = $query->result();

$compiled_select = $this->db->get_compiled_select();

?>


<div class="widget<?php if(count($query->result()) == 0 ){echo ' hide';} ?>" id="widget-<?php echo create_widget_id('tasks_not_assigned'); ?>">


  <div class="">
    <div class="panel_s">
      <div class="panel-body">
        <div class="widget-dragger"></div>

        <h4 class="pull-left mtop5"><?= _l('tasks_not_assigned'); ?></h4>
        <div class="clearfix"></div>
        <div class="row mtop5">
          <hr class="hr-panel-heading-dashboard">
        </div>
        <table class="table dataTable no-footer dtr-inline">
          <thead>
              <th>No</th>
              <th>Task Name</th>
          </thead>
          <tbody>
            <?php $i=1;?>
            <?php if (count($widget_data) > 0) { ?>
              <?php foreach ($widget_data as $widget_row) { ?>
                <tr>
                    <td><?= $i ?>
                    <td><a href="<?= admin_url('tasks/view/' . $widget_row->id) ?>"><?= $widget_row->name ?></a></td>
                </tr>
                <?php $i++; ?>
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