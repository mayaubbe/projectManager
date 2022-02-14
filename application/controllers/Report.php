<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Description of BootstrapDatatable_Model
*
* @author https://www.roytuts.com
*/
class Report extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('TaskLogModel', 'tlm');
    }
	
	function index() {
        $data['view']= $this->load->view('report', NULL,true);
        echo json_encode($data);
	}
	
	function get_report() {
		$reports = $this->tlm->get_project_report();
		echo json_encode($reports);
	}
	
	
	
	
}
/* End of file Datatable.php */
/* Location: ./application/controllers/Datatable.php */