<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
    }

    /*
    **
    **	This is a JSON Function just to check my category model function
    **
    */

    public function getAllCategoriesWithSubCategories() {
        $this->gate_model->ajax_gate();
        header('Content-Type: application/json');
        echo json_encode($this->category_model->getAllCategoriesWithSubCategories());
    }

    public function update($category_id) {
        if ($this->input->post('category_name') != $this->input->post('original_category_name')) {
            $is_unique = '|is_unique[category_table.category_name]';
        } else {
            $is_unique = '';
        }
        $this->form_validation->set_rules(
            'category_name', 'Category Name',
            'required|min_length[5]|max_length[20]'.$is_unique,
            array(
                'required' => 'You have not provided %s.',
                'is_unique' => 'This %s already exists.',
                'min_length' => 'The {field} must be at least {param} characters long',
                'max_length' => 'The {field} must be at most {param} characters long'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $error = form_error('category_name');
            $message = "<div class='alert alert-danger alert-dismissable'>";
            $message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
            $message .= "<strong>Fail!</strong> $error";
            $message .= "</div>";
            $this->session->set_flashdata('msg', $message); 
            redirect('admin/manage_category/'.$category_id);
        } else {
            $category_name = $data["category_name"] = $this->input->post('category_name');
            $data["parent_category_id"] = $this->input->post('parent_category_id');
            $update = $this->category_model->updateCategory($category_id, $data);
            if ($update) {
                $message = "<div class='alert alert-success alert-dismissable'>";
                $message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                $message .= "<strong>Success!</strong> $category_name is updated!";
                $message .= "</div>";
            } else {
                $message = "<div class='alert alert-danger alert-dismissable'>";
                $message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                $message .= "<strong>Fail!</strong> $category_name is not updated!";
                $message .= "</div>";
            }
            $this->session->set_flashdata('msg', $message); 
            redirect('admin/view_category');
        }
    }

    public function add() {
        $this->form_validation->set_rules(
            'category_name', 'Category Name',
            'required|min_length[5]|max_length[20]|is_unique[category_table.category_name]',
            array(
                'required' => 'You have not provided %s.',
                'is_unique' => 'This %s already exists.',
                'min_length' => 'The {field} must be at least {param} characters long',
                'max_length' => 'The {field} must be at most {param} characters long'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $error = form_error('category_name');
            $message = "<div class='alert alert-danger alert-dismissable'>";
            $message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
            $message .= "<strong>Fail!</strong> $error";
            $message .= "</div>";
            $this->session->set_flashdata('msg', $message); 
            redirect('admin/add_category');
        } else {
            $category_name = $data["category_name"] = $this->input->post('category_name');
            $data["parent_category_id"] = $this->input->post('parent_category_id');
            $insert = $this->category_model->addCategory($data);
            if ($insert) {
                $message = "<div class='alert alert-success alert-dismissable'>";
                $message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                $message .= "<strong>Success!</strong> $category_name is added!";
                $message .= "</div>";
            } else {
                $message = "<div class='alert alert-danger alert-dismissable'>";
                $message .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                $message .= "<strong>Fail!</strong> Fail to add $category_name";
                $message .= "</div>";
            }
            $this->session->set_flashdata('msg', $message); 
            redirect('admin/view_category');
        }
    }

}
