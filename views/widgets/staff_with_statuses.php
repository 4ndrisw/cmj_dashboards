<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php

$query = $this->db->query("SELECT `staff`.`staffid` AS `staff_id`, CONCAT( `staff`.`firstname`, ' ', `staff`.`lastname` ) AS `staff_fullname`, SUM( CASE WHEN `tasks`.`status` = 1 THEN 1 ELSE 0 END ) AS `task_status_1`, SUM( CASE WHEN `tasks`.`status` = 2 THEN 1 ELSE 0 END ) AS `task_status_2`, SUM( CASE WHEN `tasks`.`status` = 3 THEN 1 ELSE 0 END ) AS `task_status_3`, SUM( CASE WHEN `tasks`.`status` = 4 THEN 1 ELSE 0 END ) AS `task_status_4` FROM `tbltasks` AS `tasks` LEFT JOIN `tbltask_assigned` AS `assigned` ON `assigned`.`taskid` = `tasks`.`id` LEFT JOIN `tblstaff` AS `staff` ON `assigned`.`staffid` = `staff`.`staffid` GROUP BY `staff`.`staffid`");

$widget_data = $query->result();

$compiled_select = $this->db->get_compiled_select();

?>


<div class="widget" id="widget-<?php echo create_widget_id(); ?>" data-name="<?php echo _l('staff_with_statuses'); ?>">
  <div class="">
    <div class="panel_s">
      <div class="panel-body">
        <div class="widget-dragger"></div>

        <h4 class="pull-left mtop5"><?= _l('staff_with_statuses'); ?></h4>
        <div class="clearfix"></div>
        <div class="row mtop5">
          <hr class="hr-panel-heading-dashboard">
        </div>
        <table id="widget-<?php echo create_widget_id(); ?>" class="table dt-table dt-inline dataTable no-footer" data-order-col="3" data-order-type="desc">
          <thead>
            <th><?= _l('staff') ?></th>
            <th><?= _l('task_status_1') ?></th>
            <th><?= _l('task_status_2') ?></th>
            <th><?= _l('task_status_3') ?></th>
            <th><?= _l('task_status_4') ?></th>
          </thead>
          <tbody>
            <?php if (count($widget_data) > 0) { ?>
              <?php foreach ($widget_data as $widget_row) { ?>
                <tr>
                  <td><a href="<?= admin_url('staff/member/' . $widget_row->staff_id) ?>"><?= $widget_row->staff_fullname ?></a></td>
                  <td><a href="<?= site_url('cmj_dashboards/StaffWithStatuses/' . $widget_row->staff_id. '/1') ?>"><?= $widget_row->task_status_1 ?></a></td>
                  <td><a href="<?= site_url('cmj_dashboards/StaffWithStatuses/' . $widget_row->staff_id. '/2') ?>"><?= $widget_row->task_status_2 ?></a></td>
                  <td><a href="<?= site_url('cmj_dashboards/StaffWithStatuses/' . $widget_row->staff_id. '/3') ?>"><?= $widget_row->task_status_3 ?></a></td>
                  <td><a href="<?= site_url('cmj_dashboards/StaffWithStatuses/' . $widget_row->staff_id. '/4') ?>"><?= $widget_row->task_status_4 ?></a></td>
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


    <?php if(staff_can('view', 'contracts') || staff_can('view_own', 'contracts')) { ?>
    <div class="panel_s contracts-expiring">
        <div class="panel-body padding-10">
            <div class="widget-dragger"></div>
            <p class="padding-5"><?php echo _l('contracts_about_to_expire'); ?></p>
            <hr class="hr-panel-heading-dashboard">
            <?php if (!empty($expiringContracts)) { ?>
                <div class="table-vertical-scroll">
                    <a href="<?php echo admin_url('contracts'); ?>" class="mbot20 inline-block full-width"><?php echo _l('home_widget_view_all'); ?></a>
                    <table class="table dt-table" data-order-col="3" data-order-type="desc">
                        <thead>
                            <tr>
                                <th><?php echo _l('contract_list_subject'); ?> #</th>
                                <th class="<?php echo (isset($client) ? 'not_visible' : ''); ?>"><?php echo _l('contract_list_client'); ?></th>
                                <th><?php echo _l('contract_list_start_date'); ?></th>
                                <th><?php echo _l('contract_list_end_date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expiringContracts as $contract) { ?>
                                <tr>
                                    <td>
                                        <?php echo '<a href="' . admin_url("contracts/contract/" . $contract["id"]) . '">' . $contract["subject"] . '</a>'; ?>
                                    </td>
                                    <td>
                                        <?php echo '<a href="' . admin_url("clients/client/" . $contract["client"]) . '">' . get_company_name($contract["client"]) . '</a>'; ?>
                                    </td>
                                    <td>
                                        <?php echo _d($contract['datestart']); ?>
                                    </td>
                                    <td>
                                        <?php echo _d($contract['dateend']); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="text-center padding-5">
                    <i class="fa fa-check fa-5x" aria-hidden="true"></i>
                    <h4><?php echo _l('no_contracts_about_to_expire',["7"]) ; ?> </h4>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>


</div>