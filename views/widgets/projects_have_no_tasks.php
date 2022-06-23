<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php

$query = $this->db->query("SELECT `projects`.`id`,`projects`.`name` FROM `tblprojects` AS `projects` LEFT JOIN `tbltasks` AS `tasks` ON `projects`.`id` = `tasks`.`rel_id` AND `tasks`.`rel_id` is NOT NULL WHERE `tasks`.`rel_id` IS NULL AND `projects`.`status` < 5 GROUP BY `projects`.`id` LIMIT 5");
$this->db->limit(0,10);

$widget_data = $query->result();

$compiled_select = $this->db->get_compiled_select();

?>


<div class="widget<?php if(count($query->result()) == 0 ){echo ' hide';} ?>" id="widget-<?php echo create_widget_id('projects_have_no_tasks'); ?>">


  <div class="">
    <div class="panel_s">
      <div class="panel-body">
        <div class="widget-dragger"></div>

        <h4 class="pull-left mtop5"><?= _l('projects_have_no_tasks'); ?></h4>
        <div class="clearfix"></div>
        <div class="row mtop5">
          <hr class="hr-panel-heading-dashboard">
        </div>
        <div class="table-responsive">
          <table class="table dataTable no-footer dtr-inline">
            <thead>
                <th>No</th>
                <th>Project Name</th>
            </thead>
            <tbody>
              <?php $i=1;?>
              <?php if (count($widget_data) > 0) { ?>
                <?php foreach ($widget_data as $widget_row) { ?>
                  <tr>
                      <td><?= $i ?>
                      <td><a href="<?= admin_url('projects/view/' . $widget_row->id) ?>"><?= $widget_row->name ?></a></td>
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


</div>
