<?php
class m_aset_masuk extends CI_Model{
    
    function tampil_data() {
        return $query = $this->db->query("SELECT * FROM aset_masuk ORDER BY no_aset_masuk ASC");
    }
     function tampil_data_kategori_aset() {
        return $query = $this->db->query("SELECT * FROM kategori_aset ORDER BY no_kategori_aset ASC"); 
    } 
    
    function nomor_otomatis(){
    $q = $this->db->query("SELECT right(no_aset_masuk,2) as nomor FROM
    aset_masuk ORDER BY no_aset_masuk DESC");
    if ($q->num_rows()<>0){
    $nomor = intval($q->row()->nomor)+1;
    }else{
    $nomor = 1;
    }
    $ambil_nomor = str_pad($nomor, 3, "0", STR_PAD_LEFT);
    $nomor_fix = "AM".$ambil_nomor;
    return $nomor_fix;
    }
    
        function insert_data(){
        
        $data=array('no_aset_masuk'=>$this->nomor_otomatis(),
        'nama_aset'=>$this->input->post('nama_aset'),
        'kategori_aset'=>$this->input->post('kategori_aset'),
        'tanggal_masuk'=>$this->input->post('tanggal_masuk'));
        $this->db->insert('aset_masuk',$data);
       
    }
    
        function update_data(){
        $data=array('nama_aset'=>$this->input->post('nama_aset'),
        'kategori_aset'=>$this->input->post('kategori_aset'),
        'tanggal_masuk'=>$this->input->post('tanggal_masuk'));
        $this->db->where('no_aset_masuk',$this->input->post('no_aset_masuk'));
        $this->db->update('aset_masuk',$data);
    }
        
        function delete_data($no_aset_masuk){
        $this->db->where('no_aset_masuk',$no_aset_masuk);
        $this->db->delete('aset_masuk');
    }
}
