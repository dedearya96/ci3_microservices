<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
       
    }

    public function search($name)
    {
        $this->log_activity();
    }

    public function index()
    {
        $this->log_activity();
    }

    public function show($id)
    {
        $this->log_activity();
    }


    public function insert()
    {
        $this->log_activity();
    }

    public function update($id)
    {
        $this->log_activity();
    }

    public function delete($id)
    {
        $this->log_activity();
    }
}
