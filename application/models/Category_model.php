<?php

class Category_model extends CI_Model {

	
	public function getAllParentCategories() {
		return $this->db->get_where(CATEGORY, array( 'parent_category_id' => 0 ));
	}

	public function getAllSubCategories($category_id = "") {
		return $this->db->get_where(CATEGORY, array( 'parent_category_id' => $category_id ));
	}

	public function getAllCategoriesWithSubCategories() {
		$categoryData = $this->getAllParentCategories()->result();

		foreach ($categoryData as $category) {
			$category->subCategory = $this->getAllSubCategories($category->category_id)->result();
		}

		return $categoryData;
	}
}

?>