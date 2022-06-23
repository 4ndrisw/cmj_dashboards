<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  <div class="row">
                     <div class="col-sm-12"><?= _l('uncompletesd_tasks_for') .' : ' . get_staff_full_name($staff_id) ?></div>
                     <div class="col-sm-12"><?= _l('task_status') .' : '. _l('task_status_'.$status) ?></div>
                  </div>
                  <div class="table-responsive">
                     <table id="staff-with-statuses-<?=$staff_id?>" class="table table-bordered">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Company</th>
                              <th>Project Name</th>
                              <th>Task Name</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=1;?>
                           <?php if(count($tasks_by_staff) !=0){?>
                              <?php foreach ($tasks_by_staff as $key => $task){ ?>
                                 <tr>
                                    <td><?= $i ?>
                                    <td><?= get_company_name(get_client_id_by_project_id($task['rel_id']))?></td>
                                    <td><a href="<?= admin_url('projects/view/' . $task['rel_id']) ?>"><?= get_project_name_by_id($task['rel_id']) ?></a></td>
                                    <td><a href="<?= admin_url('tasks/view/' . $task['id']) ?>"><?= $task['name'] ?></a></td>
                                 </tr>
                                 <?php $i++; ?>
                              <?php } ?>
                           <?php }else{ ?>
                              <tr>
                                 <td colspan="4"> <?=_l('no_tasks_listed') ?></td>
                              </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
</body>
</html>
