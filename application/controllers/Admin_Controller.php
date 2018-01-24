<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'html2pdf.class.php';

class Admin_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('admin/admin_login');
    }

    public function admin_login_check() {
        $data = array();
        $data['email_address'] = $this->input->post('email_address', true);
        $data['password'] = md5($this->input->post('password', true));
        $result = $this->admin_model->check_admin_login_info($data['email_address'], $data['password']);
    }

    public function logout() {
        $this->session->sess_destroy();
        if(($this->session->userdata('access_level') == 1) || ($this->session->userdata('access_level') == 3)){
          redirect('admin');   
         }elseif (($this->session->userdata('access_level') == 2)) {
            redirect('teacher_login'); 
        }else{
         redirect('student_login');   
        }
       
    }

    public function dashboard() {
        if (($this->session->userdata('admin_id') != '') || ($this->session->userdata('teacher_id') != '') || ($this->session->userdata('student_id') != '')) {
            $data = array();
            $data['title'] = "dashboard";
            $this->load->view('admin/dashboard', $data);
        } else {
            redirect('admin');
        }
    }

    public function student_login() {
        $this->load->view('admin/student_login');
    }

    public function student_login_check() {
        $data = array();
        $data['reg_id'] = $this->input->post('student_id', true);
        $data['password'] = md5($this->input->post('password', true));
        $result = $this->admin_model->check_student_login_info($data['reg_id'], $data['password']);
    }

    public function sign_up_check() {
        $data = array();
        $data['reg_id'] = $this->input->post('student_id', true);
        $data['email_address'] = md5($this->input->post('email_address', true));
        $data['password'] = md5($this->input->post('password', true));
        $result = $this->admin_model->check_sign_up_info($data['reg_id'], $data['password'], $data['email_address']);
    }

    public function teacher_login() {
        $this->load->view('admin/teacher_login');
    }

    public function teacher_login_check() {
        $data = array();
        $data['reg_id'] = $this->input->post('teacher_id', true);
        $data['password'] = md5($this->input->post('password', true));
        $result = $this->admin_model->check_teacher_login_info($data['reg_id'], $data['password']);
    }

    public function add_department() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "add_department";
        $this->load->view('admin/add_department', $data);
    }

    public function view_department() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "view_department";
        $data['all_department'] = $this->admin_model->select_all_department();
        $this->load->view('admin/view_department', $data);
    }

    public function save_department() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "save_department";
        $this->form_validation->set_rules('department_name', 'Department Name', 'required|is_unique[tbl_department.dept_name]');
        $this->form_validation->set_rules('department_code', 'Department Code', 'required|is_unique[tbl_department.dept_code]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/add_department', $data);
        } else {
            $data = array();
            $data['dept_name'] = $this->input->post('department_name', true);
            $data['dept_code'] = $this->input->post('department_code', true);
            $data['dept_description'] = $this->input->post('department_description', true);
            $result = $this->admin_model->save_department_info($data);
            $this->session->set_flashdata('success', 'Successfully saved');
            redirect('add_department');
        }
    }

    public function delete_department() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $department_id = $this->uri->segment(2);
        $this->admin_model->delete_department_by_id($department_id);
        redirect('view_department');
    }

    public function edit_department() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "Edit Department";
        $department_id = $this->uri->segment(2);
        $data['result'] = $this->admin_model->select_department_by_id($department_id);
        $this->load->view('admin/edit_department', $data);
    }

    public function update_department() {
        $data = array();
        $data['title'] = "Update Department";
        $department_id = $this->uri->segment(2);
        $this->form_validation->set_rules('department_name', 'Department Name', 'required');
        $this->form_validation->set_rules('department_code', 'Department Code', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['result'] = $this->admin_model->select_department_by_id($department_id);
            $this->load->view('admin/edit_department', $data);
        } else {
            $data = array();
            $data['dept_name'] = $this->input->post('department_name', true);
            $data['dept_code'] = $this->input->post('department_code', true);
            $data['dept_description'] = $this->input->post('department_description', true);
            $this->admin_model->update_department_info($data, $department_id);
            $this->session->set_flashdata('success', 'Successfully updated');
            redirect('edit_department/' . $department_id);
        }
    }

    public function add_course() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "add_course";
        $data['all_department'] = $this->admin_model->select_all_department();
        $this->load->view('admin/add_course', $data);
    }

    public function save_course() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "save_course";
        $this->form_validation->set_rules('course_name', 'Course Name', 'required|is_unique[tbl_course.course_name]');
        $this->form_validation->set_rules('course_code', 'Course Code', 'required|is_unique[tbl_course.course_code]');
        $this->form_validation->set_rules('department_id', 'Department Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $this->load->view('admin/add_course', $data);
        } else {
            $data = array();
            $data['course_name'] = $this->input->post('course_name', true);
            $data['course_code'] = $this->input->post('course_code', true);
            $data['course_credit'] = $this->input->post('course_credit', true);
            $data['dept_id'] = $this->input->post('department_id', true);
            $data['course_description'] = $this->input->post('course_description', true);
            $result = $this->admin_model->save_course_info($data);
            $this->session->set_flashdata('success', 'Successfully saved');
            redirect('add_course');
        }
    }

    public function view_course() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "view_course";
        $data['all_course'] = $this->admin_model->select_all_course();
        $this->load->view('admin/view_course', $data);
    }

    public function delete_course() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $course_id = $this->uri->segment(2);
        $this->admin_model->delete_course_by_id($course_id);
        redirect('view_course');
    }

    public function update_course() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "update_course";
        $course_id = $this->uri->segment(2);
        $this->form_validation->set_rules('course_name', 'Course Name', 'required');
        $this->form_validation->set_rules('course_code', 'Course Code', 'required');
        $this->form_validation->set_rules('department_id', 'Department Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $data['result'] = $this->admin_model->edit_course_by_id($course_id);
            $this->load->view('admin/edit_course', $data);
        } else {
            $data = array();
            $data['course_name'] = $this->input->post('course_name', true);
            $data['course_code'] = $this->input->post('course_code', true);
            $data['course_credit'] = $this->input->post('course_credit', true);
            $data['dept_id'] = $this->input->post('department_id', true);
            $data['course_description'] = $this->input->post('course_description', true);
            $result = $this->admin_model->update_course_info($data, $course_id);
            $this->session->set_flashdata('success', 'Successfully Updated');
            redirect('edit_course/' . $course_id);
        }
    }

    public function edit_course() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "Edit Course";
        $course_id = $this->uri->segment(2);
        $data['all_department'] = $this->admin_model->select_all_department();
        $data['result'] = $this->admin_model->edit_course_by_id($course_id);
        $this->load->view('admin/edit_course', $data);
    }

    public function add_batch() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "add_batch";
        $data['all_department'] = $this->admin_model->select_all_department();
        $this->load->view('admin/add_batch', $data);
    }

    public function view_batch() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "view_batch";
        $data['all_batch'] = $this->admin_model->select_all_batch();
        $this->load->view('admin/view_batch', $data);
    }

    public function save_batch() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "save_batch";
        $this->form_validation->set_rules('batch_name', 'Batch Name', 'required|is_unique[tbl_batch.batch_name]');
        $this->form_validation->set_rules('department_id', 'Department Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $this->load->view('admin/add_batch', $data);
        } else {
            $data = array();
            $data['batch_name'] = $this->input->post('batch_name', true);
            $data['batch_description'] = $this->input->post('batch_description', true);
            $data['department_id'] = $this->input->post('department_id', true);
            $result = $this->admin_model->save_batch_info($data);
            $this->session->set_flashdata('success', 'Successfully saved');
            redirect('add_batch');
        }
    }

    public function delete_batch() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $batch_id = $this->uri->segment(2);
        $this->admin_model->delete_batch_by_id($batch_id);
        redirect('view_batch');
    }

    public function update_batch() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $batch_id = $this->uri->segment(2);
        $data = array();
        $data['title'] = "update_batch";
        $this->form_validation->set_rules('batch_name', 'Batch Name', 'required');
        $this->form_validation->set_rules('department_id', 'Department Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $data['result'] = $this->admin_model->select_batch_by_id($batch_id);
            $this->load->view('admin/edit_batch', $data);
        } else {
            $data = array();
            $data['batch_name'] = $this->input->post('batch_name', true);
            $data['batch_description'] = $this->input->post('batch_description', true);
            $data['department_id'] = $this->input->post('department_id', true);
            $result = $this->admin_model->update_batch_info($data, $batch_id);
            $this->session->set_flashdata('success', 'Successfully Updated');
            redirect('edit_batch/' . $batch_id);
        }
    }

    public function edit_batch() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "Edit Batch";
        $batch_id = $this->uri->segment(2);
        $data['all_department'] = $this->admin_model->select_all_department();
        $data['result'] = $this->admin_model->select_batch_by_id($batch_id);
        $this->load->view('admin/edit_batch', $data);
    }

    public function sign_up() {
        $data = array();
        $data['title'] = "Sign_up";
        $this->load->view('admin/sign_up', $data);
    }

    public function save_student() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "save_student";
        $this->form_validation->set_rules('student_name', 'Student Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('department_id', 'Department Name', 'required');
        $this->form_validation->set_rules('batch_id', 'Batch Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $data['all_batch'] = $this->admin_model->select_all_batch();
            $this->load->view('admin/register_student', $data);
        } else {
            $data = array();
            $data['name'] = $this->input->post('student_name', true);
            $data['email_address'] = $this->input->post('email_address', true);
            $data['password'] = md5($this->input->post('password', true));
            $data['contact_number'] = $this->input->post('contact_number', true);
            $data['address'] = $this->input->post('address', true);
            $data['department_id'] = $this->input->post('department_id', true);
            $data['batch_id'] = $this->input->post('batch_id', true);
            $batch = $this->admin_model->select_batch_by_id($data['batch_id']);
            $batch_name = $batch->batch_name;
            $dept = $this->admin_model->select_department_by_id($data['department_id']);
            $dept_name = $dept->dept_name;
            $this->db->insert('tbl_student', $data);
            $lastid = $this->db->insert_id();
            $number = $lastid;
            $id = str_pad($number + 1, 5, "0", STR_PAD_LEFT);
            $reg_id = $dept_name . '-0' . $batch_name . '-' . $id;
            $res2 = $this->admin_model->update_student_info_by_id($lastid, $reg_id);
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $student_image = $_FILES['image']['name'];
                $config['upload_path'] = './upload_image/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '52428800';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $fileinfo = $this->upload->do_upload("image");
                if (!$fileinfo) {
                    $data['error'] = $this->upload->display_errors();
                } else {
                    $update = $this->admin_model->update_student_image($lastid, $student_image);
                    if ($update == true) {
                        redirect('register_student');
                    }
                }
            }
            $this->session->set_flashdata('success', 'Successfully saved');
            redirect('register_student');
        }
    }

    public function add_teacher() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "add_teacher";
        $data['all_department'] = $this->admin_model->select_all_department();
        $this->load->view('admin/add_teacher', $data);
    }

    public function save_teacher() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "save_teacher";
        $this->form_validation->set_rules('teacher_name', 'Teacher Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
        $this->form_validation->set_rules('teacher_designation', 'Teacher Designation', 'required');
        $this->form_validation->set_rules('department_id', 'Department Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $this->load->view('admin/add_teacher', $data);
        } else {
            $data = array();
            $data['name'] = $this->input->post('teacher_name', true);
            $data['email_address'] = $this->input->post('email_address', true);
            $data['password'] = md5($this->input->post('password', true));
            $data['contact_number'] = $this->input->post('contact_number', true);
            $data['teacher_designation'] = $this->input->post('teacher_designation', true);
            $data['department_id'] = $this->input->post('department_id', true);
            $data['address'] = $this->input->post('address', true);
            $dept = $this->admin_model->select_department_by_id($data['department_id']);
            $dept_name = $dept->dept_name;
            $this->db->insert('tbl_teacher', $data);
            $lastid = $this->db->insert_id();
            $number = $lastid;
            $id = str_pad($number + 1, 5, "0", STR_PAD_LEFT);
            $reg_id = $dept_name . '-' . $id;
            $res2 = $this->admin_model->update_teacher_info_by_id($lastid, $reg_id);
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $teacher_image = $_FILES['image']['name'];
                $config['upload_path'] = './upload_image/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '52428800';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $fileinfo = $this->upload->do_upload("image");
                if (!$fileinfo) {
                    $data['error'] = $this->upload->display_errors();
                } else {
                    $update = $this->admin_model->update_teacher_image($lastid, $teacher_image);
                    if ($update == true) {
                        redirect('add_teacher');
                    }
                }
            }
            $this->session->set_flashdata('success', 'Successfully saved');
            redirect('add_teacher');
        }
    }

    public function view_teacher() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "view_teacher";
        $data['all_teacher'] = $this->admin_model->select_all_teacher();
        $this->load->view('admin/view_teacher', $data);
    }

    public function delete_teacher() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $teacher_id = $this->uri->segment(2);
        $this->admin_model->delete_teacher_by_id($teacher_id);
        redirect('view_teacher');
    }

    public function register_student() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "register_student";
        $data['all_department'] = $this->admin_model->select_all_department();
        $data['all_batch'] = $this->admin_model->select_all_batch();
        $this->load->view('admin/register_student', $data);
    }

    public function view_student() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "view_student";
        $data['all_student'] = $this->admin_model->select_all_student();
        $this->load->view('admin/view_student', $data);
    }

    public function view_staff() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "view_student";
        $data['all_staff'] = $this->admin_model->select_all_staff();
        $this->load->view('admin/view_staff', $data);
    }

    public function course_assign_to_teacher() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "course_assign_to_teacher";
        $data['all_department'] = $this->admin_model->select_all_department();
        $data['all_batch'] = $this->admin_model->select_all_batch();
        $this->load->view('admin/course_assign_to_teacher', $data);
    }

    public function select_teacher_by_id_in_ajax() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "select_teacher_by_id";
        $teacher_id = $this->input->post('teacher_id');
        $data['all_teacher'] = $this->admin_model->select_teacher_by_id_in_ajax_info($teacher_id);
        if (!empty($data['all_teacher'])) {
            $json['success'] = 1;
            $json['box'] = '<div class="control-group">';
            $json['box'] .= '<label class="control-label" for="typeahead">Credit to be Taken</label>';
            $json['box'] .= '<div class="controls ">';
            $json['box'] .= '<input type="text" name="remaining_credit" value="' . $data['all_teacher']->credit_to_be_taken . '" class="span6 typeahead" id="typeahead">';
            $json['box'] .= '</div>';
            $json['box'] .= '</div>';

            $json['box'] .= '<div class="control-group">';
            $json['box'] .= '<label class="control-label" for="typeahead">Remaining Credit</label>';
            $json['box'] .= '<div class="controls ">';
            $json['box'] .= '<input type="text" name="remaining_credit" value="' . $data['all_teacher']->credit_to_be_taken . '" class="span6 typeahead" id="typeahead">';
            $json['box'] .= '</div>';
            $json['box'] .= '</div>';
        } else {
            $json['success'] = 0;
            $json['box'] = '<div class="control-group">';
            $json['box'] .= '<label class="control-label" for="typeahead">Credit to be Taken</label>';
            $json['box'] .= '<div class="controls ">';
            $json['box'] .= '<input type="text" name="remaining_credit" value="No Credit to be taken Found!!" class="span6 typeahead" id="typeahead">';
            $json['box'] .= '</div>';
            $json['box'] .= '</div>';
        }
        echo json_encode($json);
    }

    public function select_course_by_id_in_ajax() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "select_course_by_id";
        $course_id = $this->input->post('course_id');
        $data['all_course'] = $this->admin_model->select_course_by_id_in_ajax_info($course_id);
        if (!empty($data['all_course'])) {
            $json['success'] = 1;
            $json['box'] = '<div class="control-group">';
            $json['box'] .= '<label class="control-label" for="typeahead">Course Name</label>';
            $json['box'] .= '<div class="controls ">';
            $json['box'] .= '<input type="text" name="remaining_credit" value="' . $data['all_course']->course_name . '" class="span6 typeahead" id="typeahead">';
            $json['box'] .= '</div>';
            $json['box'] .= '</div>';

            $json['box'] .= '<div class="control-group">';
            $json['box'] .= '<label class="control-label" for="typeahead">Course Credit</label>';
            $json['box'] .= '<div class="controls ">';
            $json['box'] .= '<input type="text" name="remaining_credit" value="' . $data['all_course']->course_credit . '" class="span6 typeahead" id="typeahead">';
            $json['box'] .= '</div>';
            $json['box'] .= '</div>';
        } else {
            $json['success'] = 0;
            $json['box'] = '<div class="control-group">';
            $json['box'] .= '<label class="control-label" for="typeahead">Credit to be Taken</label>';
            $json['box'] .= '<div class="controls ">';
            $json['box'] .= '<input type="text" name="remaining_credit" value="No Result Found!!" class="span6 typeahead" id="typeahead">';
            $json['box'] .= '</div>';
            $json['box'] .= '</div>';
        }
        echo json_encode($json);
    }

    public function save_course_assign_to_teacher() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "save_course_assign_to_teacher";
        $this->form_validation->set_rules('department_id', 'Department', 'required');
        $this->form_validation->set_rules('batch_id', 'Batch', 'required');
        $this->form_validation->set_rules('teacher_id', 'Teacher', 'required');
        $this->form_validation->set_rules('course_id', 'Course', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $data['all_batch'] = $this->admin_model->select_all_batch();
            $this->load->view('admin/course_assign_to_teacher', $data);
        } else {
            $data = array();
            $data['department_id'] = $this->input->post('department_id', true);
            $data['semester'] = $this->input->post('semester', true);
            $data['batch_id'] = $this->input->post('batch_id', true);
            $data['teacher_id'] = $this->input->post('teacher_id', true);
            $data['course_id'] = $this->input->post('course_id', true);
            $result = $this->admin_model->save_course_assign_to_teacher_info($data);
            $this->session->set_flashdata('success', 'Successfully saved');
            redirect('course_assign_to_teacher');
        }
    }

    public function select_department_by_id_in_ajax() {

        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "select_department_by_id";
        $department_id = $this->input->post('department_id');
        $data['all_course_info'] = $this->admin_model->select_course_by_dept_id_in_ajax_info($department_id);
        $data['all_teacher_info'] = $this->admin_model->select_teacher_by_dept_id_in_ajax_info($department_id);
        if (!empty($data['all_teacher_info'])) {
            $json['success'] = 1;
            $json['teacher'] = '<option value="">Select Teacher</option>';
            foreach ($data['all_teacher_info'] as $value) {
                $json['teacher'] .= '<option value="' . $value->teacher_id . '">' . $value->name . '</option>';
            }
            $json['course'] = '<option value="">Select Course Code</option>';
            foreach ($data['all_course_info'] as $valu) {
                $json['course'] .= '<option value="' . $valu->course_id . '">' . $valu->course_code . '</option>';
            }
        } else {
            $json['success'] = 0;
            $json['box'] = '<div class="control-group">';
            $json['box'] .= '<label class="control-label" for="typeahead">Credit to be Taken</label>';
            $json['box'] .= '<div class="controls ">';
            $json['box'] .= '<input type="text" name="remaining_credit" value="No Credit to be taken Found!!" class="span6 typeahead" id="typeahead">';
            $json['box'] .= '</div>';
            $json['box'] .= '</div>';
        }
        echo json_encode($json);
    }

    public function view_course_static() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "view_course_static";
        $data['all_course_static'] = $this->admin_model->select_all_course_static();
        $this->load->view('admin/view_course_static', $data);
    }

    public function teacher_evaluation() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "teacher_evaluation";
        $data['all_course_static'] = $this->admin_model->select_all_course_static();
        $this->load->view('admin/teacher_evaluation', $data);
    }

    public function select_course_by_id_in_ajax_for_evaluation() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "course_teacher_evaluation";
        $course_id = $this->input->post('course_id');
        $data['all_course_info'] = $this->admin_model->select_course_by_id_in_ajax_for_evaluation_info($course_id);
        if (!empty($data['all_course_info'])) {
            $json['success'] = 1;
            foreach ($data['all_course_info'] as $value) {
                $json['teacher'] = '<option value="' . $value->teacher_id . '">' . $value->name . '</option>';
                $json['course'] = '<option value="' . $value->course_name . '">' . $value->course_name . '</option>';
                $json['batch'] = '<option value="' . $value->batch_id . '">' . $value->batch_name . '</option>';
            }
        } else {
            $json['success'] = 0;
            $json['box'] = '<h3>No Course Assign Found!</h3>';
        }
        echo json_encode($json);
    }

    public function save_assesment() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "save_assesment";
        $this->form_validation->set_rules('student_id', 'Student', 'required');
        $this->form_validation->set_rules('teacher_id', 'Teacher', 'required');
        $this->form_validation->set_rules('course_id', 'Course', 'required');
        $this->form_validation->set_rules('batch_id', 'Batch', 'required');
        $this->form_validation->set_rules('teacher_rank', 'Teacher Rank', 'required');
        $this->form_validation->set_rules('relevant_exams', 'Relevent Exam', 'required');
        $this->form_validation->set_rules('teacher_punctual', 'teacher punctual', 'required');
        $this->form_validation->set_rules('teacher_satisfied', 'teacher satisfied', 'required');
        $this->form_validation->set_rules('teacher_cooperative', 'teacher cooperative', 'required');
        $this->form_validation->set_rules('teacher_respond', 'teacher respond', 'required');
        $this->form_validation->set_rules('teacher_instruction', 'teacher instruction', 'required');
        $this->form_validation->set_rules('teacher_grumpiness', 'teacher grumpiness', 'required');
        $this->form_validation->set_rules('teacher_deal', 'teacher deal', 'required');
        $this->form_validation->set_rules('teacher_utilize', 'teacher utilize', 'required');
        $this->form_validation->set_rules('total_class', 'total class', 'required');
        $this->form_validation->set_rules('performance_comment', 'performance comment', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_course_static'] = $this->admin_model->select_all_course_static();
            $this->load->view('admin/teacher_evaluation', $data);
        } else {
            $data = array();
            $data['student_id'] = $this->input->post('student_id', true);
            $data['teacher_id'] = $this->input->post('teacher_id', true);
            $data['course_id'] = $this->input->post('course_id', true);
            $data['batch_id'] = $this->input->post('batch_id', true);
            $data['teacher_rank'] = $this->input->post('teacher_rank', true);
            $data['relevant_exams'] = $this->input->post('relevant_exams', true);
            $data['teacher_punctual'] = $this->input->post('teacher_punctual', true);
            $data['teacher_satisfied'] = $this->input->post('teacher_satisfied', true);
            $data['teacher_cooperative'] = $this->input->post('teacher_cooperative', true);
            $data['teacher_respond'] = $this->input->post('teacher_respond', true);
            $data['teacher_instruction'] = $this->input->post('teacher_instruction', true);
            $data['teacher_grumpiness'] = $this->input->post('teacher_grumpiness', true);
            $data['teacher_deal'] = $this->input->post('teacher_deal', true);
            $data['teacher_utilize'] = $this->input->post('teacher_utilize', true);
            $data['total_class'] = $this->input->post('total_class', true);
            $data['performance_comment'] = $this->input->post('performance_comment', true);
            $data['course_name'] = $this->input->post('course_name', true);
            $res = $this->admin_model->select_batch_by_id($data['batch_id']);
            $batch_name = $res->batch_name;
            $data['batch_name'] = $batch_name;
            $res2 = $this->admin_model->check_teacher_assesment_info($data['student_id'], $data['teacher_id'], $data['course_id']);
            if (count($res2) > 0) {
                $this->session->set_flashdata('err', 'You Have Already Evaluate This Teacher!');
                redirect('teacher_evaluation');
            } else {
                $result = $this->admin_model->save_assesment_info($data);
                $this->session->set_flashdata('success', 'Successfully saved');
                redirect('teacher_evaluation');
            }
        }
    }

    public function view_assesment() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "view_assesment";
        $teacher_id = $this->session->userdata('teacher_id');
        if ($teacher_id == "") {
            $data['all_teacher'] = $this->admin_model->select_all_course_assign_teacher();
        } else {
            $data['all_teacher'] = $this->admin_model->select_teacher_by_id_in_ajax_info($teacher_id);
        }
        $this->load->view('admin/teacher_assesment', $data);
    }

    public function select_assesment_course_by_id_in_ajax() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "course_teacher_evaluation";
        $teacher_id = $this->input->post('teacher_id');
        $result = $this->admin_model->select_all_assesment_teacher($teacher_id);
        if (count($result) > 0) {
            $json['success'] = '1';
            $json['course_select_box'] = '';
            $json['batch_select_box'] = '';
            $json['course_select_box'] .= '<option>Select Course</option>';
            $json['batch_select_box'] .= '<option>Select Batch</option>';
            foreach ($result as $value) {
                $json['course_select_box'] .= '<option value="' . $value->course_id . '">' . $value->course_name . '</option>';
                $json['batch_select_box'] .= '<option value="' . $value->batch_id . '">' . $value->batch_name . '</option>';
            }
        } else {
            $json['success'] = '0';
            $json['nores'] = '<h3 style="color:red; margin-left:185px">No Course Assign Found ! </h3>';
        }
        echo json_encode($json);
    }

    public function select_all_assesment_by_id_in_ajax() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "course_teacher_evaluation";
        $teacher_id = $this->input->post('teacher_id');
        $course_id = $this->input->post('course_id');
        $batch_id = $this->input->post('batch_id');
        $result1 = $this->admin_model->select_asses_for_relevant_exams($teacher_id, $course_id, $batch_id);
        $result11 = $this->admin_model->select_total_row_($teacher_id, $course_id, $batch_id);
        if (count($result11) > 0) {
            $total_row = $result11->total_row;
        }
        if (count($result1->min_teacher_rank) > 0) {
            $json['success'] = 1;
            $json['min_relevant_exams'] = $result1->min_relevant_exams;
            $json['max_relevant_exams'] = $result1->max_relevant_exams;
            $json['avg_relevant_exams'] = $result1->avg_relevant_exams;
            $json['mid_relevant_exams'] = ceil($result1->sum_relevant_exams / $total_row);

            $json['min_teacher_rank'] = $result1->min_teacher_rank;
            $json['max_teacher_rank'] = $result1->max_teacher_rank;
            $json['avg_teacher_rank'] = $result1->avg_teacher_rank;
            $json['mid_teacher_rank'] = ceil($result1->sum_teacher_rank / $total_row);

            $json['min_teacher_punctual'] = $result1->min_teacher_punctual;
            $json['max_teacher_punctual'] = $result1->max_teacher_punctual;
            $json['avg_teacher_punctual'] = $result1->avg_teacher_punctual;
            $json['mid_teacher_punctual'] = ceil($result1->sum_teacher_punctual / $total_row);

            $json['min_teacher_satisfied'] = $result1->min_teacher_satisfied;
            $json['max_teacher_satisfied'] = $result1->max_teacher_satisfied;
            $json['avg_teacher_satisfied'] = $result1->avg_teacher_satisfied;
            $json['mid_teacher_satisfied'] = ceil($result1->sum_teacher_satisfied / $total_row);

            $json['min_teacher_cooperative'] = $result1->min_teacher_cooperative;
            $json['max_teacher_cooperative'] = $result1->max_teacher_cooperative;
            $json['avg_teacher_cooperative'] = $result1->avg_teacher_cooperative;
            $json['mid_teacher_cooperative'] = ceil($result1->sum_teacher_cooperative / $total_row);

            $json['min_teacher_respond'] = $result1->min_teacher_respond;
            $json['max_teacher_respond'] = $result1->max_teacher_respond;
            $json['avg_teacher_respond'] = $result1->avg_teacher_respond;
            $json['mid_teacher_respond'] = ceil($result1->sum_teacher_respond / $total_row);

            $json['min_teacher_instruction'] = $result1->min_teacher_instruction;
            $json['max_teacher_instruction'] = $result1->max_teacher_instruction;
            $json['avg_teacher_instruction'] = $result1->avg_teacher_instruction;
            $json['mid_teacher_instruction'] = ceil($result1->sum_teacher_instruction / $total_row);

            $json['min_teacher_grumpiness'] = $result1->min_teacher_grumpiness;
            $json['max_teacher_grumpiness'] = $result1->max_teacher_grumpiness;
            $json['avg_teacher_grumpiness'] = $result1->avg_teacher_grumpiness;
            $json['mid_teacher_grumpiness'] = ceil($result1->sum_teacher_grumpiness / $total_row);

            $json['min_teacher_deal'] = $result1->min_teacher_deal;
            $json['max_teacher_deal'] = $result1->max_teacher_deal;
            $json['avg_teacher_deal'] = $result1->avg_teacher_deal;
            $json['mid_teacher_deal'] = ceil($result1->sum_teacher_deal / $total_row);

            $json['min_teacher_utilize'] = $result1->min_teacher_utilize;
            $json['max_teacher_utilize'] = $result1->max_teacher_utilize;
            $json['avg_teacher_utilize'] = $result1->avg_teacher_utilize;
            $json['mid_teacher_utilize'] = ceil($result1->sum_teacher_utilize / $total_row);
        } else {
            $json['success'] = 0;
        }
        echo json_encode($json);
    }

    public function create_pdf_page_in_ajax() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
          }
        $teacher_id = $this->input->post('teacher_id');
        $course_id = $this->input->post('course_id');
        $batch_id = $this->input->post('batch_id');
        $ress3=$this->admin_model->select_semester_by_id($teacher_id,$course_id,$batch_id);
        $semester=$ress3->semester;
        $ress = $this->admin_model->edit_teacher_by_id($teacher_id);
        $teacher_name=$ress->name;
        $ress2 = $this->admin_model->select_batch_by_id($batch_id);
        $batch_name=$ress2->batch_name;
        $ress4 = $this->admin_model->edit_course_by_id($course_id);
        $course_name=$ress4->course_name;
        $result1 = $this->admin_model->select_asses_for_relevant_exams($teacher_id, $course_id, $batch_id);
        $result11 = $this->admin_model->select_total_row_($teacher_id, $course_id, $batch_id);
        if (count($result11) > 0) {
            $total_row = $result11->total_row;
        }
        if (count($result1->min_teacher_rank) > 0) {
            $setpdf = '
            <html>
            <head>
            <title>TODO supply a title</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link id="bootstrap-style" href="admin_assets/css/bootstrap.min.css" rel="stylesheet">
	    <link href="admin_assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	    <link id="base-style" href="admin_assets/css/style.css" rel="stylesheet">
            <style>
            .fdiv{
              margin-bottom: 30px;
              font-size: 18px;
                 }
             .sdiv{
              font-size:12px;
                 } 
              table, th, td {
                  padding:5px;
                }   
            </style>
           </head>
            <body class="main">
            <div class="fdiv">
            
            <table class="tbl1">
            <tr>
            <td><b>Trimester:</b></td>
            <td><b>'.$semester.'</b></td>
            </tr>
            <tr>
            <td><b>Teachers Name:</b></td>
            <td><b>'.$teacher_name.'</b></td>
            </tr>
            <tr>
            <td><b>Course Title:</b></td>
            <td><b>'.$course_name.'</b></td>
            </tr>
            <tr>
            <td><b>Batch:</b></td>
            <td><b>'.$batch_name.'</b></td>
            </tr>   
            <tr>
            <td><b>Number of Students:</b></td>
            <td><b>'.$total_row.'</b></td>
            </tr> 
             <tr>
            <td><b>Total Class(out of 24):</b></td>
            <td><b>'.floor($result1->total_class).'</b></td>
            </tr> 
          </table>
          </div>
          <div class="sdiv">
           <table>
                    <thead>
                        <tr>
                            <td><b>Questions</b></td>
                            <td><b>Average</b></td>
                            <td><b>Min</b></td>
                            <td><b>Max</b></td>
                            <td><b>Medium</b></td>
                        </tr>
                    </thead>   
                    <tbody>             
                        <tr>
                            <td>1.How Would You Rank Your Teacher ?</td>
                            <td>' . $result1->avg_teacher_rank . '</td>
                            <td>' . $result1->min_teacher_rank . '</td>
                            <td>' . $result1->max_teacher_rank . '</td>
                            <td>' . ceil($result1->sum_teacher_rank / $total_row) . '</td>
                        </tr>  
                        <tr>
                            <td>2.How much relevant were your exams, tests & assignments to the syllabus ?</td>
                            <td>' . $result1->avg_relevant_exams . '</td>
                            <td>' . $result1->min_relevant_exams . '</td>
                            <td>' . $result1->max_relevant_exams . '</td>
                            <td>' . ceil($result1->sum_relevant_exams / $total_row) . '</td>
                        </tr> 
                        <tr>
                            <td>3.How punctual was the teacher in starting and ending the lesson ?</td>
                            <td>' . $result1->avg_teacher_punctual . '</td>
                            <td>' . $result1->min_teacher_punctual . '</td>
                            <td>' . $result1->max_teacher_punctual . '</td>
                            <td>' . ceil($result1->sum_teacher_punctual / $total_row) . '</td>
                        </tr> 
                        <tr>
                            <td>4.Were you satisfied with your teachers time management in the class ?</td>
                            <td>' . $result1->avg_teacher_satisfied . '</td>
                            <td>' . $result1->min_teacher_satisfied . '</td>
                            <td>' . $result1->max_teacher_satisfied . '</td>
                            <td>' . ceil($result1->sum_teacher_satisfied / $total_row) . '</td>
                        </tr> 
                        <tr>
                            <td>5.was the teacher cooperative & willing in giving you time for counseling ?</td>
                            <td>' . $result1->avg_teacher_cooperative . '</td>
                            <td>' . $result1->min_teacher_cooperative . '</td>
                            <td>' . $result1->max_teacher_cooperative . '</td>
                            <td>' . ceil($result1->sum_teacher_cooperative / $total_row) . '</td>
                        </tr> 
                        <tr>
                            <td>6.How readily cloud your teacher respond to your question in the class ?</td>
                            <td>' . $result1->avg_teacher_respond . '</td>
                            <td>' . $result1->min_teacher_respond . '</td>
                            <td>' . $result1->max_teacher_respond . '</td>
                            <td>' . ceil($result1->sum_teacher_respond / $total_row) . '</td>
                        </tr> 
                        <tr>
                            <td>7.Did the teacher use English as the medium of instruction in the class ?</td>
                            <td>' . $result1->avg_teacher_instruction . '</td>
                            <td>' . $result1->min_teacher_instruction . '</td>
                            <td>' . $result1->max_teacher_instruction . '</td>
                            <td>' . ceil($result1->sum_teacher_instruction / $total_row) . '</td>
                        </tr> 
                        <tr>
                            <td>8.How much grumpiness your teacher cloud show while giving you feedback on your test or lesson ?</td>
                            <td>' . $result1->avg_teacher_grumpiness . '</td>
                            <td>' . $result1->min_teacher_grumpiness . '</td>
                            <td>' . $result1->max_teacher_grumpiness . '</td>
                            <td>' . ceil($result1->sum_teacher_grumpiness / $total_row) . '</td>
                        </tr> 
                        <tr>
                            <td>9.Did the teacher deal with the latest development of knowledge in your courses ?</td>
                            <td>' . $result1->avg_teacher_deal . '</td>
                            <td>' . $result1->min_teacher_deal . '</td>
                            <td>' . $result1->max_teacher_deal . '</td>
                            <td>' . ceil($result1->sum_teacher_deal / $total_row) . '</td>
                        </tr> 
                        <tr>
                            <td>10.Did the teacher utilize the modern facilities of teaching ?</td>
                            <td>' . $result1->avg_teacher_utilize . '</td>
                            <td>' . $result1->min_teacher_utilize . '</td>
                            <td>' . $result1->max_teacher_utilize . '</td>
                            <td>' . ceil($result1->sum_teacher_utilize / $total_row) . '</td>
                        </tr> 
                    </tbody>
                </table>
                </div>
                </body>
              </html>';

            try {
                $html2pdf = new HTML2PDF('P', 'A4', 'en');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($setpdf); 
                $outputfile = rand(1, 99999);
                $date=date("Y-m-d");
                $path = str_replace('application/controllers/Admin_Controller.php', '', site_url()) . 'pdf/';
                $outputfilemain = $path . $outputfile . '.pdf';
                $html2pdf->Output('pdf/' .$teacher_name.'_batch'.$batch_name.'_'.$date.'_serial'.$outputfile .'.pdf', 'F');
                $json['success'] = 1;
            } catch (HTML2PDF_exception $e) {
                echo $e;
                exit;
            }
        } else {
            $json['success'] = 0;
        }
        echo json_encode($json); 
    }

    public function add_sub_admin() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "add_sub_admin";
        $this->load->view('admin/add_sub_admin', $data);
    }

    public function save_sub_admin() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "save_sub_admin";
        $this->form_validation->set_rules('name', 'Sub-Admin Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/add_sub_admin', $data);
        } else {
            $data = array();
            $data['name'] = $this->input->post('name', true);
            $data['email_address'] = $this->input->post('email_address', true);
            $data['password'] = md5($this->input->post('password', true));
            $this->db->insert('tbl_admin', $data);
            $lastid = $this->db->insert_id();

            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $sub_admin_image = $_FILES['image']['name'];
                $config['upload_path'] = './upload_image/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '52428800';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $fileinfo = $this->upload->do_upload("image");
                if (!$fileinfo) {
                    $data['error'] = $this->upload->display_errors();
                } else {
                    $update = $this->admin_model->update_sub_admin_image($lastid, $sub_admin_image);
                    if ($update == true) {
                        redirect('add_sub_admin');
                    }
                }
            }
            $this->session->set_flashdata('success', 'Successfully saved');
            redirect('add_sub_admin');
        }
    }

    public function delete_student() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $student_id = $this->uri->segment(2);
        $this->admin_model->delete_student_by_id($student_id);
        redirect('view_student');
    }

    public function delete_staff() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $sub_admin_id = $this->uri->segment(2);
        $this->admin_model->delete_all_staff_by_id($sub_admin_id);
        redirect('view_staff');
    }

    public function delete_course_static() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $course_static_id = $this->uri->segment(2);
        $this->admin_model->delete_course_static_by_id($course_static_id);
        redirect('view_course_static');
    }

    public function update_student() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $student_id = $this->uri->segment(2);
        $data['title'] = "update_student";
        $this->form_validation->set_rules('name', 'Student Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('department_id', 'Department Name', 'required');
        $this->form_validation->set_rules('batch_id', 'Batch Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $data['all_batch'] = $this->admin_model->select_all_batch();
            $this->load->view('admin/edit_student', $data);
        } else {
            $data = array();
            $data['name'] = $this->input->post('name', true);
            $data['email_address'] = $this->input->post('email_address', true);
            $data['password'] = md5($this->input->post('password', true));
            $data['contact_number'] = $this->input->post('contact_number', true);
            $data['address'] = $this->input->post('address', true);
            $data['department_id'] = $this->input->post('department_id', true);
            $data['batch_id'] = $this->input->post('batch_id', true);
            $res2 = $this->admin_model->update_student_info($data, $student_id);
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $student_image = $_FILES['image']['name'];
                $config['upload_path'] = './upload_image/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '52428800';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $fileinfo = $this->upload->do_upload("image");
                if (!$fileinfo) {
                    $data['error'] = $this->upload->display_errors();
                } else {
                    $update = $this->admin_model->update_student_image($student_id, $student_image);
                    if ($update == true) {
                        redirect('edit_student/' . $student_id);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Successfully updated');
            redirect('edit_student/' . $student_id);
        }
    }

    public function update_teacher() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $teacher_id = $this->uri->segment(2);
        $data['title'] = "update_teacher";
        $this->form_validation->set_rules('name', 'Teacher Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
        $this->form_validation->set_rules('teacher_designation', 'Teacher Designation', 'required');
        $this->form_validation->set_rules('department_id', 'Department Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $data['result'] = $this->admin_model->edit_teacher_by_id($teacher_id);
            $this->load->view('admin/edit_teacher', $data);
        } else {
            $data = array();
            $data['name'] = $this->input->post('name', true);
            $data['email_address'] = $this->input->post('email_address', true);
            $data['contact_number'] = $this->input->post('contact_number', true);
            $data['teacher_designation'] = $this->input->post('teacher_designation', true);
            $data['department_id'] = $this->input->post('department_id', true);
            $data['address'] = $this->input->post('address', true);
            $res3 = $this->admin_model->update_teacher_by_id($data, $teacher_id);
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $teacher_image = $_FILES['image']['name'];
                $config['upload_path'] = './upload_image/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '52428800';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $fileinfo = $this->upload->do_upload("image");
                if (!$fileinfo) {
                    $data['error'] = $this->upload->display_errors();
                } else {
                    $update = $this->admin_model->update_teacher_image($teacher_id, $teacher_image);
                    if ($update == true) {
                        redirect('edit_teacher/' . $teacher_id);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Successfully Updated');
            redirect('edit_teacher/' . $teacher_id);
        }
    }

    public function edit_teacher() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "Edit Teacher";
        $teacher_id = $this->uri->segment(2);
        $data['all_department'] = $this->admin_model->select_all_department();
        $data['result'] = $this->admin_model->edit_teacher_by_id($teacher_id);
        $this->load->view('admin/edit_teacher', $data);
    }

    public function edit_student() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "Edit Student";
        $student_id = $this->uri->segment(2);
        $data['all_department'] = $this->admin_model->select_all_department();
        $data['all_batch'] = $this->admin_model->select_all_batch();
        $data['result'] = $this->admin_model->edit_student_by_id($student_id);
        $this->load->view('admin/edit_student', $data);
    }

    public function edit_sub_admin() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $data['title'] = "Edit Sub-Admin";
        $admin_id = $this->uri->segment(2);
        $data['all_department'] = $this->admin_model->select_all_department();
        $data['result'] = $this->admin_model->edit_staff_by_id($admin_id);
        $this->load->view('admin/edit_sub_admin', $data);
    }

    public function update_sub_admin() {
        if (($this->session->userdata('admin_id') == '') && ($this->session->userdata('teacher_id') == '') && ($this->session->userdata('student_id') == '')) {
            redirect('admin');
        }
        $data = array();
        $admin_id = $this->uri->segment(2);
        $data['title'] = "update_sub_admin";
        $this->form_validation->set_rules('name', 'Sub-Admin Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['all_department'] = $this->admin_model->select_all_department();
            $this->load->view('admin/edit_sub_admin', $data);
        } else {
            $data = array();
            $data['name'] = $this->input->post('name', true);
            $data['email_address'] = $this->input->post('email_address', true);
            $data['password'] = md5($this->input->post('password', true));
            $res2 = $this->admin_model->update_staff_info($data, $admin_id);
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $sub_admin_image = $_FILES['image']['name'];
                $config['upload_path'] = './upload_image/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '52428800';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $fileinfo = $this->upload->do_upload("image");
                if (!$fileinfo) {
                    $data['error'] = $this->upload->display_errors();
                } else {
                    $update = $this->admin_model->update_sub_admin_image($admin_id, $sub_admin_image);
                    if ($update == true) {
                        redirect('edit_sub_admin/' . $admin_id);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Successfully updated');
            redirect('edit_sub_admin/' . $admin_id);
        }
    }

}
