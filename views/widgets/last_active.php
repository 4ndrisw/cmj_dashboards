<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
    $CI = &get_instance();
    $CI->load->model('cmj_dashboards/cmj_dashboards_model');
    $widget_data = $CI->cmj_dashboards_model->get_last_active();
?>


<div class="widget" id="widget-<?php echo create_widget_id('last_active'); ?>">


  <div class="">
    <div class="panel_s">
      <div class="panel-body">
        <div class="widget-dragger"></div>

        <h4 class="pull-left mtop5"><?= _l('last_active'); ?></h4>
        <div class="clearfix"></div>
        <div class="row mtop5">
          <hr class="hr-panel-heading-dashboard">
          <?php 
          //echo $last_active;

          ?>
        </div>
        <table class="table dataTable no-footer dtr-inline">
          <thead>
              <th>No</th>
              <th>Name</th>
              <th>Last Login</th>
              <th>Last Activity</th>
          </thead>
          <tbody>
            <?php $i=1;?>
            <?php if (count($widget_data) > 0) { ?>
              <?php foreach ($widget_data as $widget_row) { ?>
                <tr>
                    <td><?= $i ?>
                    <td><?= $widget_row['firstname'] .' '. $widget_row['lastname'] ?></td>
                    <td><?= $widget_row['last_login'] ?>
                    <td><?= $widget_row['last_activity'] ?>
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