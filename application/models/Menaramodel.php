<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menaramodel extends CI_Model
{

    function get()
    {
        $data = $this->db->get('tb_menara');
        return $data;
    }
    function get2()
    {
        $data = $this->db->get('tb_provider');
        return $data;
    }

    function insert($data = array())
    {
        $this->db->insert('tb_menara', $data);
        $info = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Data Sukses Ditambah </div>';
        $this->session->set_flashdata('info', $info);
    }
    function update($data = array(), $where = array())
    {

        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }

        $this->db->update('tb_menara', $data);
        $info = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Data Sukses diubah </div>';
        $this->session->set_flashdata('info', $info);
    }
}
