<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class generate extends CI_Controller
 {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('model_generate');
        $this->load->model('model_certificate');
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

        $generate = $this->model_generate->getDataGenerate();
		$data['generate'] = $generate;

        $queryAllgenerate = $this->model_generate->getDatagenerate();
		$data['queryAllgenerate'] = $queryAllgenerate;
		$this->load->view('generate/generate', $data);
	}

	public function tambah_generate()
	{
		$data['generate'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['title'] = 'E - Sertifikat';

        $sertifikat = $this->model_certificate->getDatacertificate();
		$events = $this->model_events->getDataEvents();
		$desha = $this->db->query("SELECT * FROM users WHERE level='user'")->result();

		$data['certificate'] = $sertifikat;
		$data['events'] = $events;
        $data['desha'] = $desha;

        $this->load->view('generate/tambah_generate', $data);
	}
    public function edit_generate($generate_id)
	{
		$data['generate'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['title'] = 'E - Sertifikat';
        $queryAllgenerate = $this->model_generate->getDatagenerateDetail($generate_id);
		$data['queryAllgenerate'] = $queryAllgenerate;
		$this->load->view('generate/edit_generate', $data);
	}

	public function fungsi_tambah_generate()
   {
        $data['users'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $certificate_id = $this->input->post('certificate_id');
        $user_id = $this->input->post('user_id');
        $event_id = $this->input->post('event_id');
        $assigned_at = $this->input->post('assigned_at');

        $ArrInsert = array(
            'certificate_id' => $certificate_id,
            'user_id' => $user_id,
            'event_id' => $event_id,
            'assigned_at' => $assigned_at
        );
        

        $this->model_generate->insertDatagenerate($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!</div>');
        redirect('dashboard/generate');
    }

    public function hapus_generate($assignment_id)
    {
        $data['users'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->model_generate->hapusDatagenerate($assignment_id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!</div>');
        redirect('dashboard/generate');
    }

    public function download($id)
    {
        $sertifikat = $this->model_certificate->getDatacertificateDetail($id);
        $events = $this->model_events->getDataevenstDetail($id);
		
        $data['sertifikat'] = $sertifikat;
        $data['events'] = $events;

        $this->load->library('dompdf_gen');
        $this->load->view('generate/download', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('certificate.pdf', array('Attachment'=> 0));
    }

}