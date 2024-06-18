<?php
class m_kondisi_aset extends CI_Model{
    
    function tampil_data() {
        return $query = $this->db->query("SELECT * FROM kondisi_aset ORDER BY no_kondisi_aset ASC");
    }
    
    function nomor_otomatis(){
    $q = $this->db->query("SELECT right(no_kondisi_aset,2) as nomor FROM
    kondisi_aset ORDER BY no_kondisi_aset DESC");
    if ($q->num_rows()<>0){
    $nomor = intval($q->row()->nomor)+1;
    }else{
    $nomor = 1;
    }
    $ambil_nomor = str_pad($nomor, 5, "0", STR_PAD_LEFT);
    $nomor_fix = "JK".$ambil_nomor;
    return $nomor_fix;
    }
    
        function insert_data(){
        
        $data=array('no_kondisi_aset'=>$this->nomor_otomatis(),
        'nama_kondisi_aset'=>$this->input->post('nama_kondisi_aset'));
        $this->db->insert('kondisi_aset',$data);
       
    }
    
        function update_data(){
        $data=array('nama_kondisi_aset'=>$this->input->post('nama_kondisi_aset'));
        $this->db->where('no_kondisi_aset',$this->input->post('no_kondisi_aset'));
        $this->db->update('kondisi_aset',$data);
    }
        
        function delete_data($no_kondisi_aset){
        $this->db->where('no_kondisi_aset',$no_kondisi_aset);
        $this->db->delete('kondisi_aset');
    }
}
