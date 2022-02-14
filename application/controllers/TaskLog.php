<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Description of BootstrapDatatable_Model
*
* @author https://www.roytuts.com
*/
class TaskLog extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		$this->load->model('TaskLogModel', 'tlm');
		$this->load->model('TaskModel', 'tm');
    }
	
	function index() {
		$info['tasks'] = $this->tm->get_task_list();
        $data['view']= $this->load->view('task_log', $info,true);
        echo json_encode($data);
	}
	
	function get_task_logs() {
		$task_logs = $this->tlm->get_task_logs();
		echo json_encode($task_logs);
	}
	
	
	
	function add_task_log() {
		if (empty($_POST['description'])) {
			$errors['message'] = 'description is required.';
		}
		
		if (empty($_POST['hours'])) {
			$errors['message'] = 'hours is required.';
		}
		
		if (empty($_POST['task_id'])) {
			$errors['message'] = 'task is required.';
		}
		
		if (!empty($errors)) {
			$data['success'] = false;
			$data['errors'] = $errors;
		} else {
			
			$data['description'] = $_POST['description'];
			$data['hours'] = $_POST['hours'];
			$data['task_id'] = $_POST['task_id'];
			
			$data['date'] = date('Y-m-d h:i:s');
			
			if($this->tlm->add_task_log($data) === TRUE) {
				// return TRUE;
				$data['success'] = true;
				$data['message'] = 'Success!';
			}
		}
		
		
		echo json_encode($data);
	}
}
/* End of file Datatable.php */
/* Location: ./application/controllers/Datatable.php */