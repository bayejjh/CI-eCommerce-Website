<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stores extends CI_Controller {

	public function __construct()
	{
    	parent::__construct();
    	$display['cart_num'] = $this->cart->total_items();
  		$this->load->view('template/shopping_header', $display);
  	}	
	public function index()
	{
		$display['page_title'] = 'Store1';
		$this->load->model('Store');
		$display['products'] = $this->Store->get_all_products();
		$display['categories'] = $this->Store->get_all_categories();
		$this->load->view('store', $display);
	}
	public function category_store($id) {
		$this->load->model('Store');
		$display['category'] = $id;
		$display['products'] = $this->Store->get_all_in_category($id);
		$this->load->view('store', $display);
	}
	public function product_store($id) {
		// // pagination, with explanation @ https://ellislab.com/codeigniter/user-guide/libraries/pagination.html
		// //  more pagination tips https://github.com/soyosolution/CodeIgniter-pagination-library
		// // more more pagination tips http://www.storycon.us/ci3/libraries/pagination.html
		$this->load->library('pagination');
		$config['base_url'] = 'http://localhost:8888/stores/category_store';
		$config['total_rows'] = 50;
		$config['per_page'] = 10; 
		$config['num_links'] = 2;
		$config['first_link'] = 'first';
		$config['last_link'] = 'last';
		$config['next_link'] = 'next';
		$config['prev_link'] = '&lt;';
		$config['display_pages'] = FALSE;
		// $config['anchor_class'] = 'pagination_links';
		$this->pagination->initialize($config); 
		// echo $this->pagination->create_links();
		//end of pagination code

		$this->load->model('Store');
		$this->Store->get_all_in_category();
		$display['category'] = $id;
		$display['products'] = $this->Store->product_buy($id);
		$this->load->view('store', $display);
	}
	public function product_buy($id) {
		$this->load->model('Store');
		$display['id'] = $this->Store->product_buy($id);
		// $display['category'] = $id;
		$this->load->view('cart', $display);
	}
	public function show_cart() {
		$data['errors'] = $this->session->flashdata('errors');
		$data['products'] = $this->cart->contents();
		$this->load->model('Store');
		$data['states'] = $this->Store->get_states();
		$this->load->view('cart', $data);
	}
	public function add_to_cart($id) {
		$this->load->model('Store');
		$product = $this->Store->product_buy($id);
		$data[] = array(
			 	'id'      => $product['id'],
            	'qty'     => 1,
             	'price'   => $product['price'],
              	'name'    => $product['name'],
				'inventory' => $product['inventory_count']);
		$this->cart->insert($data);
		redirect('cart');
	}
	public function delete_from_cart() {
		$rowid = $this->input->post('rowid');
		$data = array(
               'rowid' => $rowid,
               'qty'   => 0);
		$this->cart->update($data);
		redirect('cart');
	}
	public function update_cart_quantity() {
		$product = $this->input->post();
		$data = array(
      			'rowid' => $product['rowid'],
               	'qty'   => $product['qty']);
		$this->cart->update($data);
		redirect('cart');
	}
	public function search_product() {
		$name = $this->input->post('name');
		$this->load->model('Store');
		$display['products'] = $this->Store->get_product_by_name($name);
		$this->load->view('product', $display);
	}
	public function submit_order() {
		$post = $this->input->post();
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|min_length[2]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|min_length[2]');
		$this->form_validation->set_rules('address', 'Address', 'required|min_length[3]');
		$this->form_validation->set_rules('address2', 'Address 2', 'min_length[2]]');
		$this->form_validation->set_rules('city', 'City', 'required|min_length[2]');
		$this->form_validation->set_rules('zip_code', 'Zipcode', 'required|min_length[5]|max_length[10]');

		if(empty($post['billing'])) {
			$this->form_validation->set_rules('billing_first_name', 'Billing First Name', 'required|alpha|min_length[2]');
			$this->form_validation->set_rules('billing_last_name', 'Billing Last Name', 'required|alpha|min_length[2]');
			$this->form_validation->set_rules('billing_address', 'Billing Address', 'required|min_length[3]');
			$this->form_validation->set_rules('billing_address2', 'Billing Address 2', 'min_length[2]');
			$this->form_validation->set_rules('billing_city', 'Billing City', 'required|min_length[2]');
			$this->form_validation->set_rules('billing_zip_code', 'Billing Zipcode', 'required|min_length[5]|max_length[10]');
			$post['billing'] = 'different';
		} else {
			$post['billing_first_name'] = $post['first_name'];
			$post['billing_last_name'] = $post['last_name'];
			$post['billing_address'] = $post['address'];
			$post['billing_address2'] = $post['address2'];
			$post['billing_city'] = $post['city'];
			$post['billing_state'] = $post['state'];
			$post['billing_zip_code'] = $post['zip_code'];
		}
		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('errors', validation_errors());
			redirect('cart');
		}
		$data['products'] = $this->cart->contents();
		$data['customer'] = $post;
		// var_dump($data);
		// die();
		$this->load->model('Store');
		$test = $this->Store->submit_order($data);
		$this->cart->destroy();
		//Need to either send a message or redirect to success page, will come back to this:
		redirect('success');
	}
	public function order_success() {
		$this->load->view('success');
	}

}//end of Controller curly