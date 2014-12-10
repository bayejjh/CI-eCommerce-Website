<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Model {
	
	public function get_all_categories()
	{
		return $this->db->query("SELECT * FROM categories")->result_array();
	}
	public function get_all_in_category($id) 
	{
		$query = "SELECT products.id, products.name, products.price, products.description, products.main_image_id, categories.name AS category FROM products
				  LEFT JOIN product_categories
				  ON products.id = product_categories.product_id
				  LEFT JOIN categories 
				  ON product_categories.category_id = categories.id
				  WHERE category_id = ?";
		$value = array($id);
		return $this->db->query($query, $value)->result_array();
	}
	public function get_all_products() 
	{
		$query = "SELECT * FROM products";
		return $this->db->query($query)->result_array();
	}
	public function product_buy($id) 
	{
		$query = "SELECT * FROM products WHERE id = {$id}";
		return $this->db->query($query)->result_array();
	}
	public function get_product_by_name($name) 
	{
		$query = "SELECT * FROM products WHERE name = ?";
		$value = array($name);
		return $this->db->query($query, $value)->result_array();
	}
}