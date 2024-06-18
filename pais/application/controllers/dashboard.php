<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {
	public function index(){
        $cek = $this->session->userdata('status_login');
        if(!empty($cek)){
            $data ['no_karyawan'] = $this->session->userdata('no_karyawan');
            $data ['nama_karyawan'] = $this->session->userdata('nama_karyawan');
            $data ['alamat'] = $this->session->userdata('alamat');
            $data ['password'] = $this->session->userdata('password');
            $data ['foto'] = $this->session->userdata('foto');
        
            $data['css_js'] = $this->load->view('v_css_js',$data,true);
            $data['navbar'] = $this->load->view('v_navbar',$data,true);
            $data['sidebar'] = $this->load->view('v_sidebar',$data,true);
            $this->load->view('v_dashboard',$data);
        }else{
            redirect('login');
        }            
    }
}
