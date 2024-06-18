<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function index()
        {
                $data['css_js'] = $this->load->view('v_css_js','',true);
                $this->load->view('v_login',$data);
        }
        function proses(){
        if (isset($_POST['btn_login'])){
            $no_karyawan = $this->input->post('no_karyawan');
            $password = $this->input->post('password');
            $this->load->model('m_karyawan');
            $proses = $this->m_karyawan->cek_login($no_karyawan,$password);
            if ($proses->row()->no_karyawan==$no_karyawan &&
        $proses->row()->password==$password){
                $data['status_login']= "true";
                $data['no_karyawan']= $proses->row()->no_karyawan;
                $data['nama_karyawan']= $proses->row()->nama_karyawan;
                $data['alamat']= $proses->row()->alamat;
                $data['password']= $proses->row()->password;
                $data['foto']= $proses->row()->foto;
                $this->session->set_userdata($data);
                redirect('dashboard');
        }else{
                    $this->session->set_flashdata('info','<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">
											<i class="icon-remove"></i>
										</button>

										<strong>
											<i class="icon-remove"></i>
											WARNING!
										</strong>

										No Admin / Password salah.
										<br>
									</div>');
            }        redirect('login');
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect ('login');
    } 
}