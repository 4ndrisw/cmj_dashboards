<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php

//$this->db->select(array('tblprojects.id AS project_id','tblprojects.name AS project_name'));
$this->db->select(array('tblstaff.firstname','tblstaff.lastname'));
$this->db->select(array('tbltasks.id','tbltasks.name'));
$this->db->select(array('tblfiles.file_name'));

$this->db->from('tblprojects'); 

$this->db->join('tbltasks', 'tbltasks.rel_id = tblprojects.id', 'left');
$this->db->join('tbltask_assigned', 'tbltask_assigned.taskid = tbltasks.id', 'left');
$this->db->join('tbltaggables', 'tbltaggables.rel_id = tbltasks.id', 'left');

$this->db->join('tblfiles', 'tblfiles.rel_id = tbltasks.id', 'left');
$this->db->join('tblstaff', 'tbltask_assigned.staffid = tblstaff.staffid', 'left');

//$this->db->where('tblprojects.status =','4');
//$this->db->where('tbltasks.status','5');
$this->db->where('tblprojects.estimated_hours', NULL);
$this->db->where('tbltaggables.rel_id', NULL);
$this->db->where('tbltasks.id IS NOT NULL');

$query = $this->db->get();
$widget_data = $query->result();
if(count($widget_data) == 0){
  return;
}

?>


<div class="widget" id="widget-<?php echo create_widget_id(); ?>" data-name="<?php echo _l('project_tasks_no_tags'); ?>">
  <div class="">
    <div class="panel_s">
      <div class="panel-body">
        <div class="widget-dragger"></div>

        <h4 class="pull-left mtop5"><?= _l('project_tasks_no_tags'); ?></h4>
        <div class="clearfix"></div>
        <div class="row mtop5">
          <hr class="hr-panel-heading-dashboard">
        </div>
        <div class="table-responsive">
        <table id="widget-<?php echo create_widget_id(); ?>" class="table dt-table" data-order-col="1" data-order-type="desc">
            <thead>
                <th>No</th>
                <th>Task Name</th>
                <th>staff</th>
            </thead>
            <tbody>
              <?php $i=1;?>
              <?php if (count($widget_data) > 0) { ?>
                <?php foreach ($widget_data as $widget_row) { ?>
                  <tr>
                      <td><?= $i ?>
                      <td><a href="<?= admin_url('tasks/view/' . $widget_row->id) ?>"><?= $widget_row->name ?></a></td>
                      <td><?= $widget_row->firstname .' '. $widget_row->lastname ?></td>
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