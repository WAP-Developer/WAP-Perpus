<?php
defined('BASEPATH') or exit('No direct Script access allowed');

class Api_model extends CI_Model
{

    // Category
    function getAllCategory()
    {
        $this->db->order_by('id_kategori', 'DESC');
        return $this->db->get('kategori')->result_array();
    }

    function getIdCat($id)
    {
        return $this->db->get_where('kategori', ['id_kategori' => $id]);
    }


    // Admin

    function getAllAdmin()
    {
        $this->db->order_by('id_admin', 'DESC');
        return $this->db->get('admin')->result_array();
    }

    function getIdAdm($id)
    {
        return $this->db->get_where('admin', ['id_admin' => $id]);
    }

    // buku
    function getAllBuku()
    {
        return $this->db->get('buku')->result_array();
    }

    function getIdBuku($id)
    {
        return $this->db->get_where('buku', ['id_buku' => $id]);
    }


    // anggota
    function getAllAnggota()
    {
        return $this->db->get('anggota')->result_array();
    }

    function getIdAnggota($id)
    {
        return $this->db->get_where('anggota', ['id_anggota' => $id]);
    }


    // Insert Category
    function insertCategory($kategori)
    {
        $this->db->insert('kategori', ['nama_kategori' => $kategori]);
    }

    // Insert Admin

    function insertAdmin($data)
    {
        $this->db->insert('admin', $data);
    }

    // Insert Anggota
    function insertAnggota($data)
    {
        $this->db->insert('anggota', $data);
    }

    // Insert Buku
    function insertBuku($data)
    {
        $this->db->insert('buku', $data);
    }


    // UpdateCategory
    function updateCategory($id, $kategori)
    {
        $this->db->update('kategori', ['nama_kategori' => $kategori], ['id_kategori' => $id]);
    }

    // UpdateAdmin
    function updateAdmin($id, $data)
    {
        $this->db->update('admin', $data, ['id_admin' => $id]);
    }

    // Update Anggota

    function updateAnggota($id, $data)
    {
        $this->db->update('anggota', $data, ['id_anggota' => $id]);
    }

    // Update Buku
    function updateBuku($id, $buku)
    {
        $this->db->update('buku', $buku, ['id_buku' => $id]);
    }

    // DeleteCategory
    function deleteCategory($id)
    {
        $this->db->delete('kategori', ['id_kategori' => $id]);
    }

    // DeleteAdmin
    function deleteAdmin($id)
    {
        $this->db->delete('admin', ['id_admin' => $id]);
    }

    // DeleteAnggota
    function deleteAnggota($id)
    {
        $this->db->delete('anggota', ['id_anggota' => $id]);
    }

    // DeleteBuku
    function deleteBuku($id)
    {
        $this->db->delete('buku', ['id_buku' => $id]);
    }
}
