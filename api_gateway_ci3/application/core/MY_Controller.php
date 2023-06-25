<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->log_activity_db = $this->load->database('log_activity', TRUE);
    }

    public function log_activity()
    {
        $activity = $this->router->class . '/' . $this->router->method;
        $user_id = $this->session->userdata('user_id');
        $status_code = http_response_code();

        $this->log_activity_db->insert('log_activity', array(
            'user_id' => null,
            'activity' => $activity,
            'status_code' => $status_code,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ));
    }
}
