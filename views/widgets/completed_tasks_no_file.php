<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php

$this->db->select(array('tblprojects.id AS project_id','tblprojects.name AS project_name'));
$this->db->select(array('tbltasks.id','tbltasks.name'));
$this->db->select(array('tblfiles.file_name'));

$this->db->limit(10,0)->from('tblprojects'); 

$this->db->join('tbltasks', 'tbltasks.rel_id = tblprojects.id', 'left');
$this->db->join('tblfiles', 'tblfiles.rel_id = tbltasks.id', 'left');

$this->db->where('tblprojects.status <','5');
$this->db->where('tbltasks.status','5');
$this->db->where('tblfiles.file_name', NULL);

$query = $this->db->get();
$widget_data = $query->result();

?>


<div class="widget<?php if(count($query->result()) == 0 ){echo ' hide';} ?>" id="widget-<?php echo create_widget_id('completed_tasks_no_file'); ?>">


  <div class="">
    <div class="panel_s">
      <div class="panel-body">
        <div class="widget-dragger"></div>

        <h4 class="pull-left mtop5"><?= _l('completed_tasks_no_file'); ?></h4>
        <div class="clearfix"></div>
        <div class="row mtop5">
          <hr class="hr-panel-heading-dashboard">
        </div>
        <div class="table-responsive">
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
</div>