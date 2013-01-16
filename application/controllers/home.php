<?php

class Home extends CI_Controller{

// page about

	// view
	function about(){
		auth_check('public');
		
		$data['pageTitle'] = '关于';
		$data['pageID'] = 'page-about';

		$this->load->view('header.php', $data);
		$this->load->view('home/about.php');
		$this->load->view('footer.php');
	}
}

?>
