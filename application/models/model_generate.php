<?php

defined('BASEPATH') or exit('No direct script access allowed');

class model_generate extends CI_Model
{
    function getDatagenerate()
    {
        $query = $this->db->get('certificate_assignment');
        return $query->result();
    }

    function insertDatagenerate($data)
    {
        $this->db->insert('certificate_assignment', $data);
    }

    function getDatagenerateDetail($id)
    {
        $this->db->where('assignment_id', $id);
        $query =  $this->db->get('certificate_assignment');
        return $query->row();
    }

    function updateDatagenerate($id, $data)
    {
        $this->db->where('assignment_id', $id);
        $this->db->update('certificate_assignment', $data);
    }

    function hapusDatagenerate($id)
    {
        $this->db->where('assignment_id', $id);
        $this->db->delete('certificate_assignment');
    }
    //function getDatakategori()
   // {
    //    $query = $this->db->get('kategori');
    //    return $query->result();
   // }
    

}