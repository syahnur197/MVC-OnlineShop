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

    public function getSubCategories($category_id = "") {
        return $this->db->get_where(CATEGORY, array( 'parent_category_id' => $category_id ));
    }
    
    /**
        Get all categories with its sub categories

        @return Array of categories with their sub categories
    **/
    
    public function getAllCategoriesWithSubCategories() {
        $categoryData = $this->getAllParentCategories()->result();
        
        foreach ($categoryData as $category) {
            $category->subCategory = $this->getSubCategories($category->category_id)->result();
        }
        
        return $categoryData;
    }
    
    /**
        Get all sub categories

        @return Array of sub categories
    **/
    
    public function getAllSubCategories(){
        return $this->db
        ->select(
            'ct1.category_name as parent_category_name, 
            ct2.category_name as category_name,
            ct2.category_id as category_id,
            ct2.parent_category_id as parent_category_id,
            COUNT(pt.product_id) as product_count')
            ->order_by('parent_category_id', 'ASC')
            ->join('product_table pt', 'ct2.category_id = pt.category_id', 'left')
            ->join('category_table ct1', 'ct1.category_id = ct2.parent_category_id', 'left')
            ->group_by('ct2.category_id')	
            ->get_where('category_table ct2');
    }
    
    /**
        Get all categories data

        @param int $category_id

        @return Array of all categories data
    **/
            
    public function getCategoryData($category_id) {
        return $this->db->get_where('category_table', array("category_id" => $category_id))->row();
    }

    /**
        Update a category

        @param int $category_id Array #data

        @return bool
    **/
    
    public function updateCategory($category_id, $data) {
        return $this->db->where("category_id", $category_id)->update('category_table', $data);
    }

    /**
        Add a category

        @param Array #data

        @return bool
    **/

    public function addCategory($data) {
        return $this->db->insert("category_table", $data);
    }
}
