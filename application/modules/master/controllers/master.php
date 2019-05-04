<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Master extends my_controller {


public function manage_calendar()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('calendar/manage-calendar');
	}
	else
	{
		redirect('index');
	}
}

public function manage_dashboard()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('dashboard/manage-dashboard');
	}
	else
	{
		redirect('index');
	}
}

function userprofileview()
{
     if($this->session->userdata('user_id') != "")
     {
   	     $this->load->view('view-user-profile');
     }
     else
     {
         redirect('index');
     }
  }


function changepassword()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('change-password');
	}
	else
	{
		redirect('index');
	}
}

function insertnewpassword()
{	
	$userid=$this->session->userdata('user_id');
	$oldpass=$this->input->post('old_password');
	$newpass=$this->input->post('new_password');

	$query = $this->db->query("select * from tbl_user_mst where status='A' AND password = '$oldpass' AND user_id = '$userid' ");
	$cntquery = $query->num_rows();

	if($cntquery > 0)
	{
		$this->db->query("update tbl_user_mst set password = '$newpass' where user_id = '$userid' ");
		$this->session->set_flashdata('msg','Password Change Successfully.');
		redirect('master/Master/userprofileview');
	}
	else
	{
		$this->session->set_flashdata('errormsg',' You Entered Wrong Old Password.');
		redirect('master/Master/changepassword');	
	}
}

	
} ?>