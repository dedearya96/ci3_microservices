<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
{
    private $baseUrl;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
        $this->baseUrl = 'http://127.0.0.1:8200';
       
    }

    public function search($name)
    {
        $url = $this->baseUrl . '/products/search/' . $name;
        $response = $this->curl->simple_get($url);
        $this->output
            ->set_content_type('application/json')
            ->set_output($response);
        $this->log_activity();
        $this->log_activity();
    }

    public function index()
    {
        $url = $this->baseUrl . '/products';
        $response = $this->curl->simple_get($url);
        $this->output
            ->set_content_type('application/json')
            ->set_output($response);
        $this->log_activity();
    }

    public function show($id)
    {
        
        $url = $this->baseUrl . '/products/' . $id;
        $response = $this->curl->simple_get($url);
        if ($response === null || empty($response)) {
            $this->output->set_status_header(500);
            $data = array('message' => 'No data available');
        } else {
            $data = json_decode($response, true);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
        $this->log_activity();
    }


    public function insert()
    {
        $url =  $url = $this->baseUrl . '/products/insert';
        $data = array_merge($this->input->post(), $this->input->get());
        $response = $this->curl->simple_post($url, $data);
        if ($response === false) {
            $error_message = $this->curl->error_string();
            $this->output->set_status_header(500);
            $response = "Error: " . $error_message;
        } else {
            $response = json_decode($response, true);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
        $this->log_activity();
    }

    public function update($id)
    {
        $url = $this->baseUrl . '/products/update/' . $id;
        $data = array_merge($this->input->post(), $this->input->get());
        $response = $this->curl->simple_post($url, $data);
        if ($response === false) {
            $error_message = $this->curl->error_string();
            $this->output->set_status_header(400);
            $response = array('error' => $error_message);
        } else {
            $response = json_decode($response, true);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
        $this->log_activity();
    }

    public function delete($id)
    {
        $url = $this->baseUrl . '/products/delete/' . $id;
        $response = $this->curl->simple_delete($url);
        if ($response === false) {
            $error_message = $this->curl->error_string();
            $this->output->set_status_header(500);
            $response = "Error: " . $error_message;
        } else {
            $response = json_decode($response, true);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
        $this->log_activity();
    }
}
