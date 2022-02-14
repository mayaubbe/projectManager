<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
/**
* Description of TaskLogModel
*
* @author maya
*/
class TaskLogModel extends CI_Model {
	
	private $task_logs = 'pt_task_logs';
	function get_task_logs() {		
		//columns
		$columns = array(
            'id_task_log',
            'description',
            'task_name',
            'hours',
            'date');
		
		//index column
        $indexColumn = 'id_task_log';
        
        //join
		$join = ' JOIN pt_tasks on id_task=task_id';
		
		//total records
		$sqlCount = 'SELECT COUNT(' . $indexColumn . ') AS row_count FROM ' . $this->task_logs;
		$totalRecords = $this->db->query($sqlCount)->row()->row_count;
		
		//pagination
		$limit = '';
		$displayStart = $this->input->get_post('start', true);
		$displayLength = $this->input->get_post('length', true);
		
		if (isset($displayStart) && $displayLength != '-1') {
            $limit = ' LIMIT ' . intval($displayStart) . ', ' . intval($displayLength);
        }
		
		$uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/%5B/", '[', $uri_string);
        $uri_string = preg_replace("/%5D/", ']', $uri_string);
        $get_param_array = explode('&', $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            $arr[$explode[0]] = $explode[1];
        }
		
		$index_of_columns = strpos($uri_string, 'columns', 1);
        $index_of_start = strpos($uri_string, 'start');
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode('&', $uri_columns);
        $arr_columns = array();
		
		foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
        }
		
		//sort order
		$order = ' ORDER BY ';
        $orderIndex = $arr['order[0][column]'];
        $orderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $orderIndex . '][orderable]'];
        if ($bSortable_ == 'true') {
            $order .= $columns[$orderIndex] . ($orderDir === 'asc' ? ' asc' : ' desc');
        }
		
		//filter
		$where = '';
        $searchVal = $arr['search[value]'];
        if (isset($searchVal) && $searchVal != '') {
            $where = " WHERE (";
            for ($i = 0; $i < count($columns); $i++) {
                $where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($searchVal) . "%' OR ";
            }
            $where = substr_replace($where, "", -3);
            $where .= ')';
        }
		
		//individual column filtering
        $searchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($columns); $i++) {
            $searchable = $arr['columns[' . $i . '][searchable]'];
            if (isset($searchable) && $searchable == 'true' && $searchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($where == '') {
                    $where = ' WHERE ';
                } else {
                    $where .= ' AND ';
                }
                $where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
            }
        }
		
		//final records
		$sql = 'SELECT ' . str_replace(' , ', ' ', implode(', ', $columns)) . ' FROM ' . $this->task_logs .$join . $where . $order . $limit;
        $result = $this->db->query($sql);
		
		//total rows
		$sql = 'SELECT COUNT(*) AS count FROM ' . $this->task_logs . $where . $order;
        $totalFilteredRows = $this->db->query($sql)->row()->count;
		
		//display structure
		$echo = $this->input->get_post('draw', true);
        $output = array(
            "draw" => intval($echo),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFilteredRows,
            "data" => array()
        );
		
		//put into 'data' array
		foreach ($result->result_array() as $cols) {
            $row = array();
            foreach ($columns as $col) {
                $row[] = $cols[$col];
            }
            $output['data'][] = $row;
        }
		
		return $output;
	}
	
	
	
	function add_task_log($data) {
				
		$this->db->insert($this->task_logs, $data);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}
	function get_project_report() {		
		//columns
		$columns = array(
            'id_project',
            'project_name',
            'hours',
            'id_task'
            );
        
        $group_by = ' Group BY id_project';
		//index column
        $indexColumn = 'id_task_log';
        
        //join
		$join = ' JOIN pt_tasks on id_task=task_id JOIN pt_projects on id_project=project_id';
		
		//total records
		$sqlCount = 'SELECT COUNT(' . $indexColumn . ') AS row_count FROM ' . $this->task_logs .$join.$group_by ;
		$totalRecords = $this->db->query($sqlCount)->row()->row_count;
		
		//pagination
		$limit = '';
		$displayStart = $this->input->get_post('start', true);
		$displayLength = $this->input->get_post('length', true);
		
		if (isset($displayStart) && $displayLength != '-1') {
            $limit = ' LIMIT ' . intval($displayStart) . ', ' . intval($displayLength);
        }
		
		$uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/%5B/", '[', $uri_string);
        $uri_string = preg_replace("/%5D/", ']', $uri_string);
        $get_param_array = explode('&', $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            $arr[$explode[0]] = $explode[1];
        }
		
		$index_of_columns = strpos($uri_string, 'columns', 1);
        $index_of_start = strpos($uri_string, 'start');
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode('&', $uri_columns);
        $arr_columns = array();
		
		foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
        }
		
		//sort order
        $order = ' ORDER BY ';

        $orderIndex = $arr['order[0][column]'];
        $orderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $orderIndex . '][orderable]'];
        if ($bSortable_ == 'true') {
            $order .= $columns[$orderIndex] . ($orderDir === 'asc' ? ' asc' : ' desc');
        }
		
		//filter
		$where = '';
        $searchVal = $arr['search[value]'];
        if (isset($searchVal) && $searchVal != '') {
            $where = " WHERE (";
            for ($i = 0; $i < count($columns); $i++) {
                $where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($searchVal) . "%' OR ";
            }
            $where = substr_replace($where, "", -3);
            $where .= ')';
        }
		
		//individual column filtering
        $searchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($columns); $i++) {
            $searchable = $arr['columns[' . $i . '][searchable]'];
            if (isset($searchable) && $searchable == 'true' && $searchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($where == '') {
                    $where = ' WHERE ';
                } else {
                    $where .= ' AND ';
                }
                $where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
            }
        }
		
		//final records
		$sql = 'SELECT ' . str_replace(' , ', ' ', implode(', ', $columns)) . ', sum(hours) as hours FROM ' . $this->task_logs .$join . $where .$group_by .  $limit;
        $result = $this->db->query($sql);
		
		//total rows
		$sql = 'SELECT COUNT(*) AS count FROM ' . $this->task_logs.$join . $where .$group_by;
        $totalFilteredRows = $this->db->query($sql)->row()->count;
		
		//display structure
		$echo = $this->input->get_post('draw', true);
        $output = array(
            "draw" => intval($echo),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFilteredRows,
            "data" => array()
        );
       
        $i = 1;
		//put into 'data' array
		foreach ($result->result_array() as $cols) {
            $row = array();
         
            $task = $this->get_task_sub($cols['id_project']);
            
            foreach ($columns as $col) {
                if($col == 'id_project'){
                    $taskString = '<tr><td colspan="4"><table width="100%;">';
                    foreach ($task as $key=>$tcol) {
            
                        // $task['task']= $tcol;
                        // $task[$key] = $tcol[$key];
                        $taskString .= "<tr><td>".$tcol['task_name']."</td><td>".$tcol['task_hours']."</td>";
                   
                    }
                    $taskString .= '</table></td></tr>';
                    $row['task'] = $taskString;
                    $cols[$col] = $i;
                }
              
                $row[$col] = $cols[$col];
               
            }
            $i++;

            $output['data'][] = $row;
        }
		
		return $output;
    }
    function get_task_sub($id) {
		$this->db->select('task_name, sum(hours) as task_hours');
        $this->db->from($this->task_logs);
        $this->db->join('pt_tasks','id_task=task_id');
        $this->db->where('project_id',$id);
        $this->db->group_by('id_task');
		$data = $this->db->get()->result_array();
		return $data;
	}
}
/* End of file TaskLogModel.php */
/* Location: ./application/models/TaskLogModel.php */