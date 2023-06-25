<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->products_db = $this->load->database('products', TRUE);
    }

    public function searchData($name)
    {
        $this->products_db->select('p.id, c.name AS category, p.name, p.price, p.description, p.created_at, p.updated_at');
        $this->products_db->from('products p');
        $this->products_db->join('market_categories.categories c', 'c.id = p.categories_id', 'left');
        $this->products_db->like('p.name', $name);
        $query = $this->products_db->get();
        return $query->result();
    }

    public function getAll()
    {
        $query = $this->products_db->query('SELECT p.id, c.name AS category, p.name, p.price, p.description, p.created_at, p.updated_at FROM products p JOIN market_categories.categories c ON c.id= p.categories_id');
        $result = $query->result();
        return $result;
    }

    public function getById($id)
    {
        $query = $this->products_db->get_where('products', ['id' => $id]);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function insertData($data)
    {
        return $this->products_db->insert('products', $data);
    }

    public function updateData($id, $data)
    {
        $this->products_db->where('id', $id);
        $this->products_db->update('products', $data);

        if ($this->products_db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id)
    {
        $this->products_db->where('id', $id);
        $this->products_db->delete('products');
        return $this->products_db->affected_rows() > 0;
    }
}
