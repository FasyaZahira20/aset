<?php
class m_kategori_aset extends CI_Model{
    
    function tampil_data() {
        return $query = $this->db->query("SELECT * FROM kategori_aset ORDER BY no_kategori_aset ASC");
    }
    
    function nomor_otomatis(){
    $q = $this->db->query("SELECT right(no_kategori_aset,2) as nomor FROM
    kategori_aset ORDER BY no_kategori_aset DESC");
    if ($q->num_rows()<>0){
    $nomor = intval($q->row()->nomor)+1;
    }else{
    $nomor = 1;
    }
    $ambil_nomor = str_pad($nomor, 3, "0", STR_PAD_LEFT);
    $nomor_fix = "KT".$ambil_nomor;
    return $nomor_fix;
    }
    
        function insert_data(){
        
        $data=array('no_kategori_aset'=>$this->nomor_otomatis(),
        'nama_kategori_aset'=>$this->input->post('nama_kategori_aset'));
        $this->db->insert('kategori_aset',$data);
       
    }
    
        function update_data(){
        $data=array('nama_kategori_aset'=>$this->input->post('nama_kategori_aset'));
        $this->db->where('no_kategori_aset',$this->input->post('no_kategori_aset'));
        $this->db->update('kategori_aset',$data);
    }
        
        function delete_data($no_kategori_aset){
        $this->db->where('no_kategori_aset',$no_kategori_aset);
        $this->db->delete('kategori_aset');
    }
}
