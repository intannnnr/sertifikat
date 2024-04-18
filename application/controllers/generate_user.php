<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class generate_user extends CI_Controller
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
		$this->load->view('user/generate_user', $data);
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