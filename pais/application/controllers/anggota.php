<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class anggota extends CI_Controller {
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
            
            $this->load->model('m_anggota');
            $data['data_anggota'] = $this->m_anggota->tampil_data()->result();
            $data['nomor_otomatis'] = $this->m_anggota->nomor_otomatis();
            $this->load->view('v_anggota',$data);
        }else{
            redirect('login');
        }            
    }
    
        function simpan(){
        $cek = $this->session->userdata('status_login');
        if(!empty($cek)){
        $this->load->model('m_anggota');
        $this->m_anggota->insert_data();
        redirect('anggota');
        }else{
        redirect('login');
        }
    }
    
    function ubah(){
        $cek = $this->session->userdata('status_login');
        if(!empty($cek)){
        $this->load->model('m_anggota');
        $this->m_anggota->update_data();
        redirect('anggota');
        }else{
        redirect('login');
        }
    }
    
    function hapus(){
        $cek = $this->session->userdata('status_login');
        if(!empty($cek)){
        $this->load->model('m_anggota');
        $no_anggota = $this->uri->segment(3);
        $this->m_anggota->delete_data($no_anggota);
        redirect('anggota');
        }else{
        redirect('login');
        }
    }
    
    function cetak(){
        $cek = $this->session->userdata('status_login');
        if(!empty($cek)){
        $this->load->library('pdf');
        $this->load->model('m_anggota');
        $pdf = new FPDF('L','mm','A4');
        $pdf->AddPage();
        $pdf->SetTitle("CETAK DAFTAR ANGGOTA");
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(260,7,"DAFTAR ANGGOTA",0,1,'C');
        $pdf->Cell(2,7,'',0,1);
        $pdf->SetFillColor(27,7,67);
        $pdf->SetTextColor(255);
        $fill=true;
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'NO',1,0,'C',$fill);
        $pdf->Cell(40,6,'NO PELANGGAN',1,0,'C',$fill);
        $pdf->Cell(40,6,'NAMA PELANGGAN',1,0,'C',$fill);
        $pdf->Cell(40,6,'ALAMAT',1,0,'C',$fill);
        $pdf->Cell(40,6,'KELOMPOK',1,0,'C',$fill);
        $pdf->Cell(40,6,'NO TELP',1,1,'C',$fill);
        $pdf->SetFont('Arial','',10);
        $pdf->SetFillColor(204,229,250);
        $pdf->SetTextColor(0);
        $fill2=false;
        $data = $this->m_anggota->tampil_data()->result();
        $no=1;
        foreach ($data as $row){
            $pdf->Cell(10,6,$no,1,0,'C',$fill2);
            $pdf->Cell(40,6,$row->no_anggota,1,0,'C',$fill2);
            $pdf->Cell(40,6,$row->nama_anggota,1,0,'L',$fill2);
            $pdf->Cell(40,6,$row->alamat,1,0,'L',$fill2);
            $pdf->Cell(40,6,$row->kelompok,1,0,'L',$fill2);
            $pdf->Cell(40,6,$row->no_telp,1,1,'L',$fill2);
            $fill2=!$fill2;
            $no++;
        }
        $pdf->Output();
    }else{
        redirect('login');
    }
}
}
