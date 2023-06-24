<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('template', 'pagination', 'form_validation', 'upload'));
    }
    public function index()
    {
        $this->template->display('menu/index');
    }
}
