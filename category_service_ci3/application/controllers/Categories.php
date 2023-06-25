<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Categories_model');
        $this->load->library('form_validation');
    }

    public function search($name)
    {
        $categories = $this->Categories_model->searchData($name);
        $jsonData = json_encode($categories);
        $this->output->set_content_type('application/json')->set_output($jsonData);
    }

    public function index()
    {
        try {
            $data = $this->Categories_model->getAll();
            $jsonData = json_encode($data);
            $this->output->set_content_type('application/json')->set_output($jsonData);
        } catch (Exception $e) {
            $response = array(
                'status' => 'error',
                'message' => $e->getMessage()
            );
            $jsonData = json_encode($response);
            $this->output->set_content_type('application/json')->set_output($jsonData);
        }
    }

    public function show($id)
    {
        $data = $this->Categories_model->getById($id);
        if ($data) {
            $jsonData = json_encode($data);
            $this->output->set_output($jsonData);
        } else {
            $jsonData = json_encode(['error' => 'Data not found']);
            http_response_code(400);
            $this->output->set_content_type('application/json')->set_output($jsonData);
        }
    }

    public function insert()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
            http_response_code(422);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->Categories_model->insertData($data);
            if ($result) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Data inserted successfully'
                );
                http_response_code(201);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Failed to insert data'
                );
                http_response_code(400);
            }
        }
        $jsonData = json_encode($response);
        $this->output->set_content_type('application/json')->set_output($jsonData);
    }

    public function update($id)
    {
        try {
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $response = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
                http_response_code(422);
            } else {
                $data = array(
                    'name' => $this->input->post('name'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                $result = $this->Categories_model->updateData($id, $data);
                if ($result) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Data updated successfullly'
                    );
                    http_response_code(201);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Failed to updated data'
                    );
                    http_response_code(400);
                }
            }
            $jsonData = json_encode($response);
            $this->output->set_content_type('application/json')->set_output($jsonData);
        } catch (Exception $e) {
            $response = array(
                'status' => 'error',
                'message' => $e->getMessage()
            );

            $jsonData = json_encode($response);
            $this->output->set_content_type('application/json')->set_output($jsonData);
        }
    }

    public function delete($id)
    {
        $result = $this->Categories_model->deleteData($id);

        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => 'Data deleted successfully'
            );
            http_response_code(201);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'ID not found or deletion failed'
            );
            http_response_code(400);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
