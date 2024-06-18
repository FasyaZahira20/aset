<?php
class m_status_aset extends CI_Model{
    
    function tampil_data() {
        return $query = $this->db->query("SELECT * FROM status_aset ORDER BY no_status_aset ASC");
    }
    
    function nomor_otomatis(){
    $q = $this->db->query("SELECT right(no_status_aset,2) as nomor FROM
    status_aset ORDER BY no_status_aset DESC");
    if ($q->num_rows()<>0){
    $nomor = intval($q->row()->nomor)+1;
    }else{
    $nomor = 1;
    }
    $ambil_nomor = str_pad($nomor, 5, "0", STR_PAD_LEFT);
    $nomor_fix = "UA".$ambil_nomor;
    return $nomor_fix;
    }
    
        function insert_data(){
        $data=array('no_status_aset'=>$this->nomor_otomatis(),
        'nama_status_aset'=>$this->input->post('nama_status_aset'));
        $this->db->insert('status_aset',$data);
       
    }
    
        function update_data(){
        $data=array('nama_status_aset'=>$this->input->post('nama_status_aset'));
        $this->db->where('no_status_aset',$this->input->post('no_status_aset'));
        $this->db->update('status_aset',$data);
    }
        
        function delete_data($no_status_aset){
        $this->db->where('no_status_aset',$no_status_aset);
        $this->db->delete('status_aset');
    }
}
