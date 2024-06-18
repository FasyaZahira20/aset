<?php
class m_anggota extends CI_Model{
    
    function tampil_data() {
        return $query = $this->db->query("SELECT * FROM anggota ORDER BY no_anggota ASC");
    }
    
    function nomor_otomatis(){
    $q = $this->db->query("SELECT right(no_anggota,2) as nomor FROM
    anggota ORDER BY no_anggota DESC");
    if ($q->num_rows()<>0){
    $nomor = intval($q->row()->nomor)+1;
    }else{
    $nomor = 1;
    }
    $ambil_nomor = str_pad($nomor, 5, "0", STR_PAD_LEFT);
    $nomor_fix = "A".$ambil_nomor;
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
        $data=array('no_anggota'=>$this->nomor_otomatis(),
        'nama_anggota'=>$this->input->post('nama_anggota'),
        'alamat'=>$this->input->post('alamat'),
        'kelompok'=>$this->input->post('kelompok'),
        'no_telp'=>$this->input->post('no_telp'),
        'foto'=>'default.png');
        $this->db->insert('anggota',$data);
        }else{
        $data=array('no_anggota'=>$this->nomor_otomatis(),
        'nama_anggota'=>$this->input->post('nama_anggota'),
        'alamat'=>$this->input->post('alamat'),
        'kelompok'=>$this->input->post('kelompok'),
        'no_telp'=>$this->input->post('no_telp'),
        'foto'=>$file1);
        $this->db->insert('anggota',$data);
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
        $data=array('nama_anggota'=>$this->input->post('nama_anggota'),
        'alamat'=>$this->input->post('alamat'),
        'kelompok'=>$this->input->post('kelompok'),
        'no_telp'=>$this->input->post('no_telp'));
 
        $this->db->where('no_anggota',$this->input->post('no_anggota'));
        $this->db->update('anggota',$data);
        }else{
        $data=array('nama_anggota'=>$this->input->post('nama_anggota'),
        'alamat'=>$this->input->post('alamat'),
        'kelompok'=>$this->input->post('kelompok'), 
        'no_telp'=>$this->input->post('no_telp'),
        'foto'=>$file1);
        $this->db->where('no_anggota',$this->input->post('no_anggota'));
        $this->db->update('anggota',$data);
        }
    }
    
    function delete_data($no_anggota){
        $this->db->where('no_anggota',$no_anggota);
        $this->db->delete('anggota');
    }
}
