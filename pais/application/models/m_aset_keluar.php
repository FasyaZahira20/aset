<?php
class m_aset_keluar extends CI_Model{
    function tampil_data() {
        return $query = $this->db->query("SELECT * FROM aset_keluar ORDER BY no_aset_keluar ASC"); 
    }
    function tampil_data_aset_masuk() {
        return $query = $this->db->query("SELECT * FROM aset_masuk ORDER BY no_aset_masuk ASC"); 
    }
   
    function tampil_data_kategori_aset() {
        return $query = $this->db->query("SELECT * FROM kategori_aset ORDER BY no_kategori_aset ASC"); 
    }
    function tampil_data_status_aset() {
        return $query = $this->db->query("SELECT * FROM status_aset ORDER BY no_status_aset ASC"); 
    }
    
    function nomor_otomatis(){
        $q = $this->db->query("SELECT right(no_aset_keluar,4) as nomor FROM aset_keluar ORDER BY no_aset_keluar DESC");
        if ($q->num_rows()<>0){
            $nomor = intval($q->row()->nomor)+1;
        }else{
            $nomor = 1;
        }
        $ambil_nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);
        $nomor_fix = "AK".$ambil_nomor;
        return $nomor_fix;
    }
    
    function insert_data(){
            $data=array('no_aset_keluar'=>$this->nomor_otomatis(),
            'aset_masuk'=>$this->input->post('aset_masuk'),
            'kategori_aset'=>$this->input->post('kategori_aset'),
            'status_aset'=>$this->input->post('status_aset'),
            'tanggal_keluar'=>$this->input->post('tanggal_keluar'),    
            'keterangan'=>$this->input->post('keterangan'));
            $this->db->insert('aset_keluar',$data);
    }
    
   function update_data(){
            $data=array('aset_masuk'=>$this->input->post('aset_masuk'),
            'kategori_aset'=>$this->input->post('kategori_aset'),
            'status_aset'=>$this->input->post('status_aset'),
            'tanggal_keluar'=>$this->input->post('tanggal_keluar'),    
            'keterangan'=>$this->input->post('keterangan'));
            $this->db->where('no_aset_keluar',$this->input->post('no_aset_keluar'));
            $this->db->update('aset_keluar',$data);
     
            $this->db->where('no_aset_keluar',$this->input->post('no_aset_keluar'));
            $this->db->update('aset_keluar',$data);
        
    }
    
    function delete_data($no_aset_keluar){
        $this->db->where('no_aset_keluar',$no_aset_keluar);
        $this->db->delete('aset_keluar');
    }
}