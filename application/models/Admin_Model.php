<?php

class Admin_Model extends CI_Model {

    public function check_admin_login_info($email_address, $password) {
        $this->db->select('admin_id,name,email_address,password,access_level');
        $this->db->from('tbl_admin');
        $this->db->where(array('email_address' => $email_address, 'password' => $password));
        $query = $this->db->get()->result();
        if (count($query) > 0) {
            foreach ($query as $row) {
                $session = array(
                    'admin_id' => $row->admin_id,
                    'name' => $row->name,
                    'access_level' => $row->access_level,
                );
            }
            $this->session->set_userdata($session);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('loginerr', ' Wrong Email and Password, Try Again');
            redirect('admin');
        }
    }

    public function check_student_login_info($reg_id, $password) {
        $this->db->select('student_id,name,email_address,password,access_level,reg_id,sign_up');
        $this->db->from('tbl_student');
        $this->db->where(array('reg_id' => $reg_id, 'password' => $password));
        $query = $this->db->get()->result();
        if (count($query) > 0) {
            foreach ($query as $row) {
                if ($row->sign_up == 0) {
                    $this->session->set_flashdata('loginerr', 'Please! SignUp Before Login');
                    redirect('student_login');
                } else {
                    $session = array(
                        'student_id' => $row->student_id,
                        'name' => $row->name,
                        'access_level' => $row->access_level,
                    );
                    $this->session->set_userdata($session);
                    redirect('teacher_evaluation');
                }
            }
        } else {
            $this->session->set_flashdata('loginerr', ' Wrong Id OR Password, Try Again');
            redirect('student_login');
        }
    }

    public function check_sign_up_info($reg_id, $password, $email_address) {
        $this->db->select('*');
        $this->db->from('tbl_student');
        $this->db->where('reg_id', $reg_id);
        $query = $this->db->get()->result();
        if (count($query) > 0) {
            $this->db->where('reg_id', $reg_id);
            $this->db->set('password', $password);
            $this->db->set('email_address', $email_address);
            $this->db->set('sign_up', 1);
            $this->db->update('tbl_student');
            redirect('student_login');
        } else {
            $this->session->set_flashdata('loginerr', 'Id is invalid, Try Again');
            redirect('sign_up');
        }
    }

    public function check_teacher_login_info($reg_id, $password) {
        $this->db->select('teacher_id,name,email_address,password,access_level,reg_id');
        $this->db->from('tbl_teacher');
        $this->db->where(array('reg_id' => $reg_id, 'password' => $password));
        $query = $this->db->get()->result();
        if (count($query) > 0) {
            foreach ($query as $row) {
                $session = array(
                    'teacher_id' => $row->teacher_id,
                    'name' => $row->name,
                    'access_level' => $row->access_level,
                );
            }
            $this->session->set_userdata($session);
            redirect('view_assesment');
        } else {
            $this->session->set_flashdata('loginerr', ' Wrong Id OR Password, Try Again');
            redirect('teacher_login');
        }
    }

    public function save_department_info($data) {
        $this->db->insert('tbl_department', $data);
        return true;
    }

    public function save_batch_info($data) {
        $this->db->insert('tbl_batch', $data);
        return true;
    }

    public function select_all_department() {
        $this->db->select('*');
        $this->db->from('tbl_department');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function update_department_info($data, $department_id) {
        $this->db->where('dept_id', $department_id);
        $this->db->update('tbl_department', $data);
        return true;
    }

    public function update_teacher_by_id($data, $teacher_id) {
        $this->db->where('teacher_id', $teacher_id);
        $this->db->update('tbl_teacher', $data);
        return true;
    }

    public function select_all_staff() {
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function select_all_batch() {
        $this->db->select('tbl_batch.*,tbl_department.dept_id,tbl_department.dept_name');
        $this->db->from('tbl_batch');
        $this->db->join('tbl_department', 'tbl_batch.department_id=tbl_department.dept_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function delete_department_by_id($department_id) {
        $this->db->where('dept_id', $department_id);
        $this->db->delete('tbl_department');
    }

    public function select_all_student() {
        $this->db->select('tbl_department.*,tbl_batch.*,tbl_student.*');
        $this->db->from('tbl_department');
        $this->db->join('tbl_batch', 'tbl_department.dept_id=tbl_batch.department_id', 'INNER');
        $this->db->join('tbl_student', 'tbl_batch.batch_id=tbl_student.batch_id', 'INNER');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function select_student_info_by_id($lastid_reg_val) {
        $this->db->select('*');
        $this->db->from('tbl_student');
        $this->db->where('student_id', $lastid_reg_val);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function update_teacher_info_by_id($lastid, $reg_id) {
        $this->db->where('teacher_id', $lastid);
        $this->db->set('reg_id', $reg_id);
        $this->db->update('tbl_teacher');
        return true;
    }

    public function select_department_by_id($dept_id) {
        $this->db->select('*');
        $this->db->from('tbl_department');
        $this->db->where('dept_id', $dept_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function update_student_info_by_id($lastid, $reg_id) {
        $this->db->where('student_id', $lastid);
        $this->db->set('reg_id', $reg_id);
        $this->db->update('tbl_student');
        return true;
    }

    public function save_course_info($data) {
        $this->db->insert('tbl_course', $data);
        return true;
    }

    public function select_all_course() {
        $this->db->select('tbl_course.*,tbl_department.dept_id,tbl_department.dept_name');
        $this->db->from('tbl_course');
        $this->db->join('tbl_department', 'tbl_course.dept_id=tbl_department.dept_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function delete_course_by_id($course_id) {
        $this->db->where('course_id', $course_id);
        $this->db->delete('tbl_course');
    }

    public function update_teacher_image($lastid, $teacher_image) {
        $this->db->where('teacher_id', $lastid);
        $this->db->set('teacher_image', $teacher_image);
        $this->db->update('tbl_teacher');
        return true;
    }

    public function select_all_teacher() {
        $this->db->select('tbl_teacher.*,tbl_department.dept_id,tbl_department.dept_name');
        $this->db->from('tbl_teacher');
        $this->db->join('tbl_department', 'tbl_teacher.department_id=tbl_department.dept_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function delete_teacher_by_id($teacher_id) {
        $this->db->where('teacher_id', $teacher_id);
        $this->db->delete('tbl_teacher');
    }

    public function select_teacher_by_id_in_ajax_info($teacher_id) {
        $this->db->select('*');
        $this->db->from('tbl_teacher');
        $this->db->where('teacher_id', $teacher_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function select_course_by_id_in_ajax_info($course_id) {
        $this->db->select('*');
        $this->db->from('tbl_course');
        $this->db->where('course_id', $course_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function select_batch_by_id($batch_id) {
        $this->db->select('*');
        $this->db->from('tbl_batch');
        $this->db->where('batch_id', $batch_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function select_course_by_dept_id_in_ajax_info($department_id) {
        $this->db->select('tbl_department.*,tbl_course.*');
        $this->db->from('tbl_department');
        $this->db->join('tbl_course', 'tbl_department.dept_id=tbl_course.dept_id');
        $this->db->where('tbl_department.dept_id', $department_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function select_teacher_by_dept_id_in_ajax_info($department_id) {
        $this->db->select('tbl_department.*,tbl_teacher.*');
        $this->db->from('tbl_department');
        $this->db->join('tbl_teacher', 'tbl_department.dept_id=tbl_teacher.department_id');
        $this->db->where('tbl_department.dept_id', $department_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function save_course_assign_to_teacher_info($data) {
        $this->db->insert('tbl_course_assign', $data);
        return true;
    }

    public function select_all_course_static() {
        $this->db->select('tbl_course_assign.*,tbl_department.*,tbl_course.*,tbl_teacher.*,tbl_batch.*');
        $this->db->from('tbl_course_assign');
        $this->db->join('tbl_department', 'tbl_course_assign.department_id=tbl_department.dept_id', 'INNER');
        $this->db->join('tbl_course', 'tbl_course_assign.course_id=tbl_course.course_id', 'INNER');
        $this->db->join('tbl_teacher', 'tbl_course_assign.teacher_id=tbl_teacher.teacher_id', 'INNER');
        $this->db->join('tbl_batch', 'tbl_course_assign.batch_id=tbl_batch.batch_id', 'INNER');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function select_all_course_assign_teacher() {
        $this->db->select('tbl_course_assign.*,tbl_department.*,tbl_course.*,tbl_teacher.*,tbl_batch.*');
        $this->db->from('tbl_course_assign');
        $this->db->join('tbl_department', 'tbl_course_assign.department_id=tbl_department.dept_id', 'INNER');
        $this->db->join('tbl_course', 'tbl_course_assign.course_id=tbl_course.course_id', 'INNER');
        $this->db->join('tbl_teacher', 'tbl_course_assign.teacher_id=tbl_teacher.teacher_id', 'INNER');
        $this->db->join('tbl_batch', 'tbl_course_assign.batch_id=tbl_batch.batch_id', 'INNER');
        $this->db->group_by('tbl_course_assign.teacher_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function save_classroom_info($data) {
        $this->db->insert('tbl_classroom', $data);
        return true;
    }

    public function select_all_classroom() {
        $this->db->select('*');
        $this->db->from('tbl_classroom');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function update_student_image($lastid, $student_image) {
        $this->db->where('student_id', $lastid);
        $this->db->set('student_image', $student_image);
        $this->db->update('tbl_student');
        return true;
    }

    public function select_course_by_id_in_ajax_for_evaluation_info($course_id) {
        $this->db->select('tbl_department.*,tbl_course.*,tbl_course_assign.*,tbl_teacher.*,tbl_batch.*');
        $this->db->from('tbl_department');
        $this->db->join('tbl_course', 'tbl_department.dept_id=tbl_course.dept_id', 'INNER');
        $this->db->join('tbl_course_assign', 'tbl_course.course_id=tbl_course_assign.course_id', 'INNER');
        $this->db->join('tbl_teacher', 'tbl_course_assign.teacher_id=tbl_teacher.teacher_id', 'INNER');
        $this->db->join('tbl_batch', 'tbl_course_assign.batch_id=tbl_batch.batch_id', 'INNER');
        $this->db->where('tbl_course.course_id', $course_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function save_assesment_info($data) {
        $this->db->insert('tbl_teacher_assesment', $data);
        return true;
    }

    public function select_all_assesment_by_id($teacher_id) {
        $this->db->select('*');
        $this->db->from('tbl_teacher_assesment');
        $this->db->where('teacher_id', $teacher_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function select_asses_for_relevant_exams($teacher_id, $course_id, $batch_id) {
        $query = $this->db->query("SELECT MIN(relevant_exams) as min_relevant_exams,MAX(relevant_exams) as max_relevant_exams,AVG(relevant_exams) as avg_relevant_exams,SUM(relevant_exams) as sum_relevant_exams
            ,MIN(teacher_rank) as min_teacher_rank,MAX(teacher_rank) as max_teacher_rank,AVG(teacher_rank) as avg_teacher_rank,SUM(teacher_rank) as sum_teacher_rank,
            MIN(teacher_punctual) as min_teacher_punctual,MAX(teacher_punctual) as max_teacher_punctual,AVG(teacher_punctual) as avg_teacher_punctual,SUM(teacher_punctual) as sum_teacher_punctual,
            MIN(teacher_satisfied) as min_teacher_satisfied,MAX(teacher_satisfied) as max_teacher_satisfied,AVG(teacher_satisfied) as avg_teacher_satisfied,SUM(teacher_satisfied) as sum_teacher_satisfied,
            MIN(teacher_cooperative) as min_teacher_cooperative,MAX(teacher_cooperative) as max_teacher_cooperative,AVG(teacher_cooperative) as avg_teacher_cooperative,SUM(teacher_cooperative) as sum_teacher_cooperative,
            MIN(teacher_respond) as min_teacher_respond,MAX(teacher_respond) as max_teacher_respond,AVG(teacher_respond) as avg_teacher_respond,SUM(teacher_respond) as sum_teacher_respond,
            MIN(teacher_instruction) as min_teacher_instruction,MAX(teacher_instruction) as max_teacher_instruction,AVG(teacher_instruction) as avg_teacher_instruction,SUM(teacher_instruction) as sum_teacher_instruction,
            MIN(teacher_grumpiness) as min_teacher_grumpiness,MAX(teacher_grumpiness) as max_teacher_grumpiness,AVG(teacher_grumpiness) as avg_teacher_grumpiness,SUM(teacher_grumpiness) as sum_teacher_grumpiness,
            MIN(teacher_deal) as min_teacher_deal,MAX(teacher_deal) as max_teacher_deal,AVG(teacher_deal) as avg_teacher_deal,SUM(teacher_deal) as sum_teacher_deal,
            MIN(teacher_utilize) as min_teacher_utilize,MAX(teacher_utilize) as max_teacher_utilize,AVG(teacher_utilize) as avg_teacher_utilize,SUM(teacher_utilize) as sum_teacher_utilize,
            AVG(total_class) as total_class
         FROM tbl_teacher_assesment WHERE teacher_id=" . $teacher_id . " AND course_id=" . $course_id . " AND batch_id=" . $batch_id . "");
        $result = $query->row();
        return $result;
    }

    public function select_total_row_($teacher_id, $course_id, $batch_id) {
        $query = $this->db->query("Select Count(*) as total_row FROM tbl_teacher_assesment WHERE teacher_id=" . $teacher_id . " AND course_id=" . $course_id . " AND batch_id=" . $batch_id . "");
        $result = $query->row();
        return $result;
    }

    public function update_sub_admin_image($lastid, $sub_admin_image) {
        $this->db->where('admin_id', $lastid);
        $this->db->set('image', $sub_admin_image);
        $this->db->update('tbl_admin');
        return true;
    }

    public function select_all_assesment() {
        $this->db->select('tbl_teacher_assesment.*,tbl_course.*,tbl_teacher.*,tbl_batch.*');
        $this->db->from('tbl_teacher_assesment');
        $this->db->join('tbl_course', 'tbl_teacher_assesment.course_id=tbl_course.course_id', 'INNER');
        $this->db->join('tbl_teacher', 'tbl_teacher_assesment.teacher_id=tbl_teacher.teacher_id', 'INNER');
        $this->db->join('tbl_batch', 'tbl_course.batch_id=tbl_batch.batch_id', 'INNER');
        //$this->db->where('tbl_course.course_id', $course_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function select_all_assesment_teacher($teacher_id) {
        $this->db->select('tbl_course_assign.*,tbl_department.*,tbl_course.*,tbl_teacher.*,tbl_batch.*');
        $this->db->from('tbl_course_assign');
        $this->db->join('tbl_department', 'tbl_course_assign.department_id=tbl_department.dept_id', 'INNER');
        $this->db->join('tbl_course', 'tbl_course_assign.course_id=tbl_course.course_id', 'INNER');
        $this->db->join('tbl_teacher', 'tbl_course_assign.teacher_id=tbl_teacher.teacher_id', 'INNER');
        $this->db->join('tbl_batch', 'tbl_course_assign.batch_id=tbl_batch.batch_id', 'INNER');
        $this->db->where('tbl_teacher.teacher_id', $teacher_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function delete_all_staff_by_id($sub_admin_id) {
        $this->db->where('admin_id', $sub_admin_id);
        $this->db->delete('tbl_admin');
    }

    public function delete_batch_by_id($batch_id) {
        $this->db->where('batch_id', $batch_id);
        $this->db->delete('tbl_batch');
    }

    public function delete_student_by_id($student_id) {
        $this->db->where('student_id', $student_id);
        $this->db->delete('tbl_student');
    }

    public function delete_course_static_by_id($course_static_id) {
        $this->db->where('course_assign_id', $course_static_id);
        $this->db->delete('tbl_course_assign');
    }

    public function edit_staff_by_id($sub_admin_id) {
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->where('admin_id', $sub_admin_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function update_staff_info($data, $sub_admin_id) {
        $this->db->where('admin_id', $sub_admin_id);
        $this->db->update('tbl_admin', $data);
        return true;
    }

    public function edit_batch_by_id($batch_id) {
        $this->db->select('*');
        $this->db->from('tbl_batchselect_course_by_id');
        $this->db->where('batch_id', $batch_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function update_batch_info($data, $batch_id) {
        $this->db->where('batch_id', $batch_id);
        $this->db->update('tbl_batch', $data);
        return true;
    }

    public function edit_student_by_id($student_id) {
        $this->db->select('*');
        $this->db->from('tbl_student');
        $this->db->where('student_id', $student_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function update_student_info($data, $student_id) {
        $this->db->where('student_id', $student_id);
        $this->db->update('tbl_student', $data);
        return true;
    }

    public function edit_course_by_id($course_id) {
        $this->db->select('*');
        $this->db->from('tbl_course');
        $this->db->where('course_id', $course_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function update_course_info($data, $course_id) {
        $this->db->where('course_id', $course_id);
        $this->db->update('tbl_course', $data);
        return true;
    }

    public function edit_teacher_by_id($teacher_id) {
        $this->db->select('*');
        $this->db->from('tbl_teacher');
        $this->db->where('teacher_id', $teacher_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function check_teacher_assesment_info($student_id, $teacher_id, $course_id) {
        $this->db->select('*');
        $this->db->from('tbl_teacher_assesment');
        $this->db->where(array('student_id' => $student_id, 'teacher_id' => $teacher_id,'course_id' => $course_id));
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    public function select_semester_by_id($teacher_id,$course_id,$batch_id){
        $this->db->select('semester');
        $this->db->from('tbl_course_assign');
        $this->db->where(array('batch_id' => $batch_id, 'teacher_id' => $teacher_id,'course_id' => $course_id));
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;  
    }

}
