<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class members_details extends CI_Model
{
    
    function  clicked_members_getdetails($member_id){
        // pull all the records into an array
                
        $this->db->select('*')
          ->from('members AS m')
          ->where('m.members_id ',$member_id );
        
        $query = $this->db->get();

        if ( $query->num_rows() > 0 ){
  	    foreach ($query->result() as $row) {
  	    	$data[] = $row; 
  	    }
            return $data;
        }
        else
            return 0;
    }
    
    function  members_getdetails()
    {
        $this->load->database('dccper_task');
        $this->db->select('*')
          ->from('members AS m, projects AS p, mem_proj as mp')
          ->where('m.members_id = mp.members_id and p.project_id = mp.project_id')       
          ->where('p.project_id = 1 ')  ;
           

        $query = $this->db->get();

        if ( $query->num_rows() > 0 ){
  	    foreach ($query->result() as $row) {
  	    	$data[] = $row ; 
  	    }
            return $data;
        }
        else
            return 0;
    }
    
    function  members_task_getdetails($id, $num=5, $start=0 ){
        
        // pull all the records into an array
        
        $this->load->database();
        
        
        
        $this->db->limit($start, $num);
        
        $this->db->select('task_name, start_date , end_date, est_time, hours_spent')
          ->from('members AS m, projects AS p, tasks as t, mem_proj as mp, mem_task as mt, project_task as pt')
          ->where('m.members_id = mp.members_id and m.members_id = mt.members_id and p.project_id = mp.project_id and p.project_id = pt.project_id and t.tasks_id = mt.tasks_id and t.tasks_id = pt.tasks_id')       
          ->where('m.members_id ', $id)
          ->where('p.project_id=1')
          ->order_by('t.start_date');
          
        $query = $this->db->get();

        if ( $query->num_rows() > 0 ){
  	    foreach ($query->result() as $row) {
  	    	$data[] = $row; 
  	    }
            return $data;
        }
        
        

    }
    
    function  record_count($member_id){
        // pull all the records into an array
        $this->db->select('task_name, start_date , end_date, est_time, hours_spent')
          ->from('members AS m, projects AS p, tasks as t, mem_proj as mp, mem_task as mt, project_task as pt')
          ->where('m.members_id = mp.members_id and p.project_id = mp.project_id and m.members_id = mt.members_id and t.tasks_id = mt.tasks_id and t.tasks_id = pt.tasks_id')       
          ->where('m.members_id ',$member_id );
           

        
        $query = $this->db->get();

        
        if ( $query->num_rows() > 0 ){
  	    return $query->num_rows();
        }
    }
}    