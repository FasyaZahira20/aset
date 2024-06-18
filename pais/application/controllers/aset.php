<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class aset extends CI_Controller {
    public function index(){
        $cek  = $this->session->userdata('status_login');
        if(!empty($cek)){
            $data['no_karyawan'] = $this->session->userdata('no_karyawan');
            $data['nama_karyawan'] = $this->session->userdata('nama_karyawan');
            $data['alamat'] = $this->session->userdata('alamat');
            $data['password'] = $this->session->userdata('password');
            $data['foto'] = $this->session->userdata('foto');

            $data['css_js'] = $this->load->view('v_css_js', $data, true);
            $data['navbar'] = $this->load->view('v_navbar', $data, true);
            $data['sidebar'] = $this->load->view('v_sidebar', $data, true);
            
            $this->load->model('m_aset');
            $data['data_aset'] = $this->m_aset->tampil_data()->result();
            $data['nomor_otomatis'] = $this->m_aset->nomor_otomatis(); 
            $data['data_aset_masuk'] = $this->m_aset->tampil_data_aset_masuk();
            $data['data_kondisi_aset'] = $this->m_aset->tampil_data_kondisi_aset();
            $data['data_kategori_aset'] = $this->m_aset->tampil_data_kategori_aset();
            $data['data_status_aset'] = $this->m_aset->tampil_data_status_aset();
            $this->load->view('v_aset',$data);
        }else{
            redirect('login');	
	}
    }
    
    function simpan(){
        $cek  = $this->session->userdata('status_login');
        if(!empty($cek)){
            $this->load->model('m_aset');
            $this->m_aset->insert_data();
            redirect('aset');
        }else{
            redirect('login');	
	}
    }
    
     function ubah(){
        $cek  = $this->session->userdata('status_login');
        if(!empty($cek)){
            $this->load->model('m_aset');
            $this->m_aset->update_data();
            redirect('aset');
        }else{
            redirect('login');	
	}
    }
   
    function hapus(){
        $cek  = $this->session->userdata('status_login');
        if(!empty($cek)){
            $this->load->model('m_aset');
            $no_aset = $this->uri->segment(3);
            $this->m_aset->delete_data($no_aset);
            redirect('aset');
        }else{
            redirect('login');	
	}
    }
   
    function cetak(){
        $cek  = $this->session->userdata('status_login');
        if(!empty($cek)){   
            $this->load->library('pdf');		  
            $this->load->model('m_aset');
            $pdf = new FPDF('L','mm','A4');
            $pdf->AddPage();
            $pdf->SetTitle("CETAK DAFTAR ASET");
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(260,7,"DAFTAR ASET",0,1,'C');
            $pdf->Cell(2,7,'',0,1);
            $pdf->SetFillColor(27,7,67);
            $pdf->SetTextColor(255);
            $fill=true;
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(10,6,'NO',1,0,'C',$fill);
            $pdf->Cell(25,6,'KODE',1,0,'C',$fill);
            $pdf->Cell(40,6,'NAMA ASET',1,0,'C',$fill);
            $pdf->Cell(30,6,'KONDISI',1,0,'C',$fill);
            $pdf->Cell(40,6,'KATEGORI ASET',1,0,'C',$fill);
            $pdf->Cell(30,6,'STATUS',1,0,'C',$fill);
            $pdf->Cell(30,6,'STOK',1,0,'C',$fill);
            $pdf->Cell(55,6,'KETERANGAN',1,1,'C',$fill);
            $pdf->SetFont('Arial','',10);
            $pdf->SetFillColor(204,229,250);
            $pdf->SetTextColor(0);
            $fill2=false;
            $data = $this->m_aset->tampil_data()->result();
            $no=1;
            foreach ($data as $row){
                $pdf->Cell(10,6,$no,1,0,'C',$fill2);
                $pdf->Cell(25,6,$row->no_aset,1,0,'C',$fill2);
                $pdf->Cell(40,6,$row->aset_masuk,1,0,'L',$fill2);
                $pdf->Cell(30,6,$row->kondisi_aset,1,0,'C',$fill2);
                $pdf->Cell(40,6,$row->kategori_aset,1,0,'C',$fill2);
                $pdf->Cell(30,6,$row->status_aset,1,0,'C',$fill2);
                $pdf->Cell(30,6,$row->stok,1,0,'C',$fill2);
                $pdf->Cell(55,6,$row->keterangan,1,1,'C',$fill2);
                
                $fill2=!$fill2;
                $no++;
            }
            $pdf->Output();                
	}else{
            redirect('login');	
	}
    }
}