<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class home extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
       	$this->load->helper('url');
	$this->load->model('members_details');
        $this->load->library('pagination');
    }	
    
    public function index(){
        
        $data['allmembers'] =  $this->members_details->members_getdetails();
        $data['tasks'] = NULL;
        $data['clicked_member'] = NULL;
        $data["links"] = NULL;
        $this->load->view('project_management',$data) ;
    }
    
    public function member_info($id, $start = 0) {
       
        $data['allmembers'] =  $this->members_details->members_getdetails();
        $data['clicked_member'] =  $this->members_details->clicked_members_getdetails($id);
        $data['tasks'] =  $this->members_details->members_task_getdetails($id,$start,5);
        
     
        $config["base_url"] = base_url() . 'index.php/home/member_info/'.$id.'/';
        $total_row = $this->members_details->record_count($id);
        var_dump($total_row);
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['display_pages'] = FALSE;
        $perpage = $config["per_page"];
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = FALSE;
        $config['num_links'] = $total_row;
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['next_link'] = '>';
        $config['prev_link'] = '<';

        $this->pagination->initialize($config);
        
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('project_management', $data) ;
    }
    
    public function settings(){
        $this->load->view('settings') ;
    }  
}



