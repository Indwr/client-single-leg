<?php

defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('asia/kolkata');
    }

    public function index()
    {
        $this->load->view('index');
    }

    public function About()
    {
        $this->load->view('about');
    }

    public function Contact()
    {
        $this->load->view('contact');
    }
}
