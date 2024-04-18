<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {


	public function index()
	{
		
		$data['title'] = 'Dashboard Admin | Sertifikat Online';
		$this->load->view('template/auth/auth_header', $data);
		$this->load->view('dashboard/admin');
		$this->load->view('template/auth/auth_footer');
		}
	}