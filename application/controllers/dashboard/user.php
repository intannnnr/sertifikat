<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {


	public function index()
	{
		
		$data['title'] = 'Dashboard User Sertifikat Online';
		$this->load->view('template/auth/auth_header', $data);
		$this->load->view('dashboard/user');
		$this->load->view('template/auth/auth_footer');
		}
	}