<?php
class m_karyawan extends CI_Model{
    function cek_login ($no_karyawan,$password) {
        return $query = $this->db->query("select * from karyawan where no_karyawan="."'".$no_karyawan."' and password='".$password."'");
    }
    
    function tampil_data() {
        return $query = $this->db->query("SELECT * FROM karyawan ORDER BY no_karyawan ASC");
    }
    
    function nomor_otomatis(){
    $q = $this->db->query("SELECT right(no_karyawan,2) as nomor FROM
    karyawan ORDER BY no_karyawan DESC");
    if ($q->num_rows()<>0){
    $nomor = intval($q->row()->nomor)+1;
    }else{
    $nomor = 1;
    }
    $ambil_nomor = str_pad($nomor, 2, "0", STR_PAD_LEFT);
    $nomor_fix = "admin".$ambil_nomor;
    return $nomor_fix;
    }
    
        function insert_data(){
        $config['upload_path'] = './assets/avatars/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 10000;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;
        $this->load->library('upload', $config);
        $this->upload->do_upload('foto');
        $file1=$this->upload->data('file_name');
        if (!$file1){
        $data=array('no_karyawan'=>$this->nomor_otomatis(),
        'nama_karyawan'=>$this->input->post('nama_karyawan'),
        'alamat'=>$this->input->post('alamat'),
        'password'=>$this->input->post('password'),
        'foto'=>'default.png');
        $this->db->insert('karyawan',$data);
        }else{
        $data=array('no_karyawan'=>$this->nomor_otomatis(),
        'nama_karyawan'=>$this->input->post('nama_karyawan'),
        'alamat'=>$this->input->post('alamat'),
        'password'=>$this->input->post('password'),
        'foto'=>$file1);
        $this->db->insert('karyawan',$data);
        }
    }
    
        function update_data(){
        $config['upload_path'] = './assets/avatars/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 10000;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;
        $this->load->library('upload', $config);
        $this->upload->do_upload('foto');
        $file1=$this->upload->data('file_name');
        if (!$file1){
        $data=array('nama_karyawan'=>$this->input->post('nama_karyawan'),
        'alamat'=>$this->input->post('alamat'),
        'password'=>$this->input->post('password'));
        $this->db->where('no_karyawan',$this->input->post('no_karyawan'));
        $this->db->update('karyawan',$data);
        }else{
        $data=array('nama_karyawan'=>$this->input->post('nama_karyawan'),
        'alamat'=>$this->input->post('alamat'),
        'password'=>$this->input->post('password'),
        'foto'=>$file1);
        $this->db->where('no_karyawan',$this->input->post('no_karyawan'));
        $this->db->update('karyawan',$data);
        }
    }
    
    function delete_data($no_karyawan){
        $this->db->where('no_karyawan',$no_karyawan);
        $this->db->delete('karyawan');
    }
}
