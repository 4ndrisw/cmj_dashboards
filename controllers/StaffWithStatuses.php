<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class StaffWithStatuses extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tasks_model');
        $this->load->model('staff_model');
    }


    public function index(){
        $data['title']                 = _l('staff_with_statuses');
        $this->load->view('staffwithstatuses/blank_page', $data);
    }

    /* List staff and task status */
    public function info($staff_id, $status){

        $tasks_by_staff = $this->tasks_model->get_tasks_by_staff_id($staff_id,$where = ['status'=>$status]);

        $data['staff_id'] = $staff_id;
        $data['status'] = $status;
        $data['tasks_by_staff'] = $tasks_by_staff;
        $data['title']                 = _l('staff_with_statuses');
        $this->load->view('staffwithstatuses/info', $data);
    }


}