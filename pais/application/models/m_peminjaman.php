<?php
class m_peminjaman extends CI_Model{
    function tampil_data() {
        return $query = $this->db->query("SELECT * FROM peminjaman ORDER BY no_peminjaman ASC"); 
    }
    function tampil_data_aset_masuk() {
        return $query = $this->db->query("SELECT * FROM aset_masuk ORDER BY no_aset_masuk ASC"); 
    }
   
    
    function nomor_otomatis(){
        $q = $this->db->query("SELECT right(no_peminjaman,4) as nomor FROM peminjaman ORDER BY no_peminjaman DESC");
        if ($q->num_rows()<>0){
            $nomor = intval($q->row()->nomor)+1;
        }else{
            $nomor = 1;
        }
        $ambil_nomor = str_pad($nomor, 4, "0", STR_PAD_LEFT);
        $nomor_fix = "PE".$ambil_nomor;
        return $nomor_fix;
    }
    
    function insert_data(){
            $data=array('no_peminjaman'=>$this->nomor_otomatis(),
            'nama_peminjam'=>$this->input->post('nama_peminjam'),    
            'aset_masuk'=>$this->input->post('aset_masuk'),
            'jumlah'=>$this->input->post('jumlah'),
            'tanggal_pinjam'=>$this->input->post('tanggal_pinjam'),
            'tanggal_kembali'=>$this->input->post('tanggal_kembali'),
            'deskripsi'=>$this->input->post('deskripsi'),    
            'status'=>$this->input->post('status'));
            $this->db->insert('peminjaman',$data);
    }
    
   function update_data(){
            $data=array('aset_masuk'=>$this->input->post('aset_masuk'),
            'nama_peminjam'=>$this->input->post('nama_peminjam'),
            'jumlah'=>$this->input->post('jumlah'),    
            'tanggal_pinjam'=>$this->input->post('tanggal_pinjam'),
            'tanggal_kembali'=>$this->input->post('tanggal_kembali'),    
            'deskripsi'=>$this->input->post('deskripsi'),
            'status'=>$this->input->post('status'));
            $this->db->where('no_peminjaman',$this->input->post('no_peminjaman'));
            $this->db->update('peminjaman',$data);
            $this->db->where('no_peminjaman',$this->input->post('no_peminjaman'));
            $this->db->update('peminjaman',$data);
        
    }
    
    function delete_data($no_peminjaman){
        $this->db->where('no_peminjaman',$no_peminjaman);
        $this->db->delete('peminjaman');
    }
}