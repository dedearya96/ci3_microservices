<?php defined('BASEPATH') or exit('No direct script access allowed');

class Categories_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->categories_db = $this->load->database('categories', TRUE);
    }

    public function searchData($name)
    {
        $this->categories_db->like('name', $name);
        $query = $this->categories_db->get('categories');
        return $query->result();
    }

    public function getAll()
    {
        $query = $this->categories_db->query('SELECT * FROM categories');
        $result = $query->result();
        return $result;
    }

    public function getById($id)
    {
        $query = $this->categories_db->get_where('categories', ['id' => $id]);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function insertData($data)
    {
        return $this->categories_db->insert('categories', $data);
    }

    public function updateData($id, $data)
    {
        $this->categories_db->where('id', $id);
        $this->categories_db->update('categories', $data);

        if ($this->categories_db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id)
    {
        $this->categories_db->where('id', $id);
        $this->categories_db->delete('categories');
        return $this->categories_db->affected_rows() > 0;
    }

    public function categoryExists($category_id)
    {
        $this->categories_db->where('id', $category_id);
        $query = $this->categories_db->get('categories');
        return $query->num_rows() > 0;
    }
}
