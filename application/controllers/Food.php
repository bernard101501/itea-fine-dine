<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Food extends CI_Controller
{



	public function index()
	{
		$this->load->view('main');
	}

	public function customer_detail(){
		$this->load->view('customer_detail');
	}

	public function starter(){
		$this->load->view('starter');
	}
}
