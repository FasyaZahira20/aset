<?php
class m_maintenance extends CI_Model{
    function tampil_data() {
        return $query = $this->db->query("SELECT * FROM maintenance ORDER BY no_maintenance ASC"); 
    }
    function tampil_data_aset_masuk() {
        return $query = $this->db->query("SELECT * FROM aset_masuk ORDER BY no_aset_masuk ASC"); 
    }
   
    
    function nomor_otomatis(){
        $q = $this->db->query("SELECT right(no_maintenance,4) as nomor FROM maintenance ORDER BY no_maintenance DESC");
        if ($q->num_rows()<>0){
            $nomor = intval($q->row()->nomor)+1;
        }else{
            $nomor = 1;
        }
        $ambil_nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);
        $nomor_fix = "MT".$ambil_nomor;
        return $nomor_fix;
    }
    
    function insert_data(){
            $data=array('no_maintenance'=>$this->nomor_otomatis(),   
            'aset_masuk'=>$this->input->post('aset_masuk'),
            'tanggal_mulai'=>$this->input->post('tanggal_mulai'),
            'tanggal_selesai'=>$this->input->post('tanggal_selesai'),
            'biaya'=>$this->input->post('biaya'));
            $this->db->insert('maintenance',$data);
    }
    
   function update_data(){
            $data=array('aset_masuk'=>$this->input->post('aset_masuk'),  
            'tanggal_mulai'=>$this->input->post('tanggal_mulai'),
            'tanggal_selesai'=>$this->input->post('tanggal_selesai'),    
            'biaya'=>$this->input->post('biaya'),);
            $this->db->where('no_maintenance',$this->input->post('no_maintenance'));
            $this->db->update('maintenance',$data);
            
            $this->db->where('no_maintenance',$this->input->post('no_maintenance'));
            $this->db->update('maintenance',$data);
        
    }
    
    function delete_data($no_maintenance){
        $this->db->where('no_maintenance',$no_maintenance);
        $this->db->delete('maintenance');
    }
}