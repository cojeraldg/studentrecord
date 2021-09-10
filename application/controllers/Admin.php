<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function dashboard (){
        $this -> load ->model ('queries');
        $users = $this -> queries -> viewAllColleges();
        $this -> load -> view ('dashboard', ['users' => $users]);
    }

    public function addCollege () {
        $this -> load -> view ('addCollege');
    }

    public function addStudent () {
        $this -> load ->model ('queries');
        $colleges = $this -> queries -> getColleges();
        $this -> load -> view ('addStudent', ['colleges' => $colleges]);

    }


    public function createCollege (){
        $this -> form_validation -> set_rules ('collegename', 'College Name', 'required');
		$this -> form_validation -> set_rules ('branch', 'Branch', 'required');
		if($this -> form_validation -> run () ) {
           $data = $this -> input -> post();
           $this -> load -> model ('queries');
           if ( $this -> queries -> makeCollege($data)){
               $this -> session -> set_flashdata ('message', 'College Created Successfully');

           }
           else {
            $this -> session -> set_flashdata ('message', 'Failed to Create College');
           }
           return redirect ("admin/addCollege");

        }
            else {
               $this -> addCollege();

            }
        }

        public function  addCoadmin(){
            $this->load->model('queries');
            $roles = $this -> queries -> getRoles();
            $colleges = $this -> queries -> getColleges();
            $this -> load -> view ('addCoadmin', ['roles' => $roles, 'colleges' => $colleges]);
        }

        public function createCoadmin (){
            $this -> form_validation -> set_rules ('username', 'Username', 'required');
            $this -> form_validation -> set_rules ('college_id', 'College Name', 'required');
            $this -> form_validation -> set_rules ('email', 'Email', 'required');
            $this -> form_validation -> set_rules ('gender', 'Gender', 'required');
            $this -> form_validation -> set_rules ('role_id', 'Role', 'required');
            $this -> form_validation -> set_rules ('password', 'Password', 'required');
            $this -> form_validation -> set_rules ('confpwd', 'Confpwd', 'required');
        
        
            if($this -> form_validation -> run () ) {
                $data = $this -> input -> post();
                $data['password'] = sha1 ($this -> input -> post ('password'));
                $data['confpwd'] = sha1 ($this -> input -> post ('confpwd'));
                 $this-> load -> model ('queries');
                if ($this -> queries -> registerCoadmin($data)) {
                    $this-> session -> set_flashdata('message', 'Co Admin Registered Successfully');
                  
                }
                else {
                    $this -> session -> set_flashdata('message', 'Failed to Register Admin!');
                } 

                return redirect ("admin/addCoadmin");
                
            }
            else {
                $this -> addCoadmin();
            }

        }

        public function createStudent (){
            $this -> form_validation -> set_rules ('studentname', 'Student Name', 'required');
            $this -> form_validation -> set_rules ('college_id', 'College Name', 'required');
            $this -> form_validation -> set_rules ('email', 'Email', 'required');
            $this -> form_validation -> set_rules ('gender', 'Gender', 'required');
            $this -> form_validation -> set_rules ('course', 'Course', 'required');
            if($this -> form_validation -> run () ) {
               $data = $this -> input -> post();
               $this -> load -> model ('queries');
               if ($this -> queries -> insertStudent ($data) ) {
                   $this -> session -> set_flashdata ('message', 'Student Added Successfully');
               }
        

        else {
            $this -> session -> set_flashdata ('message', 'Failed to Add Student!');
        }

        return redirect ("admin/addStudent");

        

    }
        else {
            $this -> addStudent();

        }
    } 

    public function viewStudents (){
        $this -> load -> model ('queries');
        $students = $this -> queries -> getStudents ();
        $this -> load -> view ('viewStudents', ['students' => $students]);

    }

        public function editStudent($id){
             $this -> load -> model ('queries');
             $colleges = $this -> queries -> getColleges();
             $studentData = $this -> queries -> getStudentRecord($id);
             $this -> load -> view ('editStudent', ['colleges' => $colleges, 'studentData' => $studentData]);

        }

        public function modifyStudent($id) {
            $this -> form_validation -> set_rules ('studentname', 'Student Name', 'required');
            $this -> form_validation -> set_rules ('college_id', 'College Name', 'required');
            $this -> form_validation -> set_rules ('email', 'Email', 'required');
            $this -> form_validation -> set_rules ('gender', 'Gender', 'required');
            $this -> form_validation -> set_rules ('course', 'Course', 'required');
            if($this -> form_validation -> run () ) {
               $data = $this -> input -> post();
               $this -> load -> model ('queries');
               if ($this -> queries -> updateStudent ($data, $id) ) {
                   $this -> session -> set_flashdata ('message', 'Student Update Successfully');
               }
        

        else {
            $this -> session -> set_flashdata ('message', 'Failed to Add Student!');
        }

        return redirect ("admin/editStudent/{$id}");

        

    }
        else {
            $this -> editStudent;

        }

        }

        public function deleteStudent($id){
            $this -> load -> model ('queries');
            if($this -> queries -> removeStudent ($id) ) {
                return redirect ("admin/dashboard");
            }

        }

        public function __construct(){
             parent :: __construct();
                 if (!$this -> session -> userdata ("user_id") )
                    return redirect ("welcome/login");
   
        
    }
    
    
}