<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class events extends CI_Controller
 {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('model_events');


    //    if (!$this->session->userdata('username')) {
     //       $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">please login!</div>');
      //      redirect('auth_admin');
      //  }
    }

	
	public function index()
	{
		$data['users'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['title'] = 'E - Sertifikat';
        $queryAllevents = $this->model_events->getDataevents();
		$data['queryAllevents'] = $queryAllevents;
		$this->load->view('dataevents/events', $data);
	}

	public function tambah_events()
	{
		$data['events'] = $this->db->get_where('events', ['event_id' => $this->session->userdata('event_id')])->row_array();
		$data['title'] = 'E - Sertifikat';
        $queryAllevents = $this->model_events->getDataevents();
		$data['queryAllevents'] = $queryAllevents;
        $this->load->view('dataevents/tambah_events');
	}
    public function edit_events($event_id)
	{
		$data['events'] = $this->db->get_where('events', ['event_id' => $this->session->userdata('event_id')])->row_array();
		$data['title'] = 'E - Sertifikat';
        $queryAllevents = $this->model_events->getDataevenstDetail($event_id);
		$data['queryAllevents'] = $queryAllevents;
		$this->load->view('dataevents/edit_events', $data);
	}

	public function fungsi_tambah_events()
   {
        $data['users'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $event_name = $this->input->post('event_name');
        $event_date = $this->input->post('event_date');
        $location = $this->input->post('location');
        $organizer = $this->input->post('organizer');
       

        $ArrInsert = array(
            'event_name' => $event_name,
            'event_date' => $event_date,
            'location' => $location,
            'organizer' => $organizer
        
        );
        

        $this->model_events->insertDataevents($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!</div>');
        redirect('dashboard/events');
    }

    public function fungsi_edit_events()
    {
         $data['users'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
         $event_id = $this->input->post('event_id');
         $event_name = $this->input->post('event_name');
         $event_date = $this->input->post('event_date');
         $location = $this->input->post('location');
         $organizer = $this->input->post('organizer');
        
 
         $ArrInsert = array(
            'event_id' => $event_id,
             'event_name' => $event_name,
             'event_date' => $event_date,
             'location' => $location,
             'organizer' => $organizer
         
         );
         
 
         $this->model_events->updatedataevents($event_id, $ArrInsert);
         $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!</div>');
         redirect('dashboard/events');
     }

    public function hapus_events($event_id)
    {
        $data['events'] = $this->db->get_where('events', ['event_id' => $this->session->userdata('event_id')])->row_array();

        $this->model_events->hapusDataevents($event_id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!</div>');
        redirect('dashboard/events');
    }
}