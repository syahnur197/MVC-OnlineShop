<?php

class Category_model extends CI_Model {

	/**
        Get all parent categories

        @return PHP Object of all parent categories
    **/
	public function getAllParentCategories() {
		return $this->db->get_where(CATEGORY, array( 'parent_category_id' => 0 ));
	}

	/**
        Get sub categories of specific parent categories

        @param int $category_id

        @return PHP Object of sub categories
    **/

	public function getAllSubCategories($category_id = "") {
		return $this->db->get_where(CATEGORY, array( 'parent_category_id' => $category_id ));
	}

	/**
        Get all categories with its sub categories

        @return Array of categories with their sub categories
    **/

	public function getAllCategoriesWithSubCategories() {
		$categoryData = $this->getAllParentCategories()->result();

		foreach ($categoryData as $category) {
			$category->subCategory = $this->getAllSubCategories($category->category_id)->result();
		}

		return $categoryData;
	}
}

?>