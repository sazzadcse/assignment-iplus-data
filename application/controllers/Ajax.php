<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

	public $_module      = 'user';


	// load index/root route
	public function get_districts() {

        $result     = ['status' => false, 'options' => [] ];
        $options    = '<option>Select District..</option>';

        if( !empty( $this->input->post('division_id') ) ){
            $district_id = $this->input->post('district_id');
            $params['division_id'] = $this->input->post('division_id');
            $districts = $this->global_model->get('districts', $params);

            if( !empty( $districts ) ){
                foreach ( $districts as $dist ) {
                    $selected = !empty($district_id) && $district_id == $dist->id ? 'selected' : '';
                    $options .= '<option '. $selected .' value="'. $dist->id .'">' . $dist->district_en . '</option>';
                }
            }

            $result = [ 'status' => true, 'options' => $options ];

        }

        echo json_encode( $result );
        die();
		
	}
	
    // load index/root route
	public function get_upazilas() {

        $result     = ['status' => false, 'options' => [] ];
        $options    = '<option>Select Upazila/Thana..</option>';

        $params = [];

        if( !empty( $this->input->post('district_id') ) ) {
            $upazila_id = $this->input->post('upazila_id');
            $params['district_id'] = $this->input->post('district_id');
            $upazilas = $this->global_model->get('upazilas', $params);

            if( !empty( $upazilas ) ){
                foreach ( $upazilas as $upz ) {
                    $selected = !empty($upazila_id) && $upazila_id == $upz->id ? 'selected' : '';
                    $options .= '<option '.$selected.' value="'. $upz->id .'">' . $upz->upazila_en . '</option>';
                }
            }

            $result = [ 'status' => true, 'options' => $options ];

        }

        echo json_encode( $result );
        die();
		
	}

    // define add applicant
    public function add_applicant() {
        
        $response = ['status' => true, 'message' => 'Registration Failed, Try Again!'];
        $applicant_data = $this->input->post();
        
        if( $applicant_data ){
            
            $this->form_validation->set_rules('applicant_name', 'Applicant Name', 'trim|required')
                                  ->set_rules('applicant_email', 'Email Address', 'trim|required|is_unique[applicants.applicant_email]', array('is_unique' => 'An account with this email already exists'))
                                  ->set_rules('applicant_division', 'Division', 'trim|required')
                                  ->set_rules('applicant_district', 'District', 'trim|required')
                                  ->set_rules('applicant_upazila', 'Upazila/Thana', 'trim|required')
                                  ->set_rules('address_details', 'Address Details', 'trim|required')
                                  ->set_rules('language_proficiency_bangla', 'Bangla Language', 'trim|required')
                                  ->set_rules('language_proficiency_english', 'English Language', 'trim')
                                  ->set_rules('language_proficiency_french', 'French Language', 'trim')
                                  ->set_rules('language_proficiency_french', 'French Language', 'trim')
                                  ->set_rules('applicant_exam_name[]', 'Exam Name', 'trim|required')
                                  ->set_rules('applicant_university[]', 'University', 'trim|required')
                                  ->set_rules('applicant_board[]', 'Board', 'trim|required')
                                  ->set_rules('applicant_result[]', 'Result', 'trim|required')
                                  ->set_rules('training', 'Training', 'trim|required')
                                  ->set_rules('training_name[]', 'Traning Name', 'trim|required')
                                  ->set_rules('training_details[]', 'Traning Details', 'trim|required')
                        ;

                if ($this->form_validation->run() == FALSE) {

                    $errors = validation_errors();

                    $response = [ 'status' => true, 'message' => $errors ];
        
                } else {
        
                    $this->db->trans_start();

                    $insert_data = [
                        'applicant_name' => $applicant_data['applicant_name'],
                        'applicant_email' => $applicant_data['applicant_email'],
                        'applicant_division' => $applicant_data['applicant_division'],
                        'applicant_district' => $applicant_data['applicant_district'],
                        'applicant_upazila' => $applicant_data['applicant_upazila'],
                        'address_details' => $applicant_data['address_details'],
                        'language_proficiency_bangla' => $applicant_data['language_proficiency_bangla'],
                        'language_proficiency_english' => isset( $applicant_data['language_proficiency_english'] ) ? $applicant_data['language_proficiency_english'] : '',
                        'language_proficiency_french' => isset( $applicant_data['language_proficiency_french'] ) ? $applicant_data['language_proficiency_french'] : '',
                        'applicant_photo' => '', //phote
                        'applicant_cv' => '', //cv
                        'is_training' => $applicant_data['training'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'status' => 'active',
                    ];


                    if($this->global_model->insert('applicants', $insert_data)) {

                        $applicant_id = $this->db->insert_id();

                        //education
                        $insert_education = [];
                        foreach( $applicant_data['applicant_exam_name'] AS $k => $val ) {
                            
                            $insert_education = [
                                'applicant_id' => $applicant_id,
                                'exam_name' => $val,
                                'university_name' => $applicant_data['applicant_university'][$k],
                                'board_name' => $applicant_data['applicant_board'][$k],
                                'result' => $applicant_data['applicant_result'][$k],
                                'created_at' => date('Y-m-d H:i:s'),
                                'status' => 'active',
                            ];

                            $this->global_model->insert('applicant_educations', $insert_education);
                        }
                        
                        //traning
                        $insert_training = [];
                        foreach( $applicant_data['training_name'] AS $k => $val ) {
                            
                            $insert_training = [
                                'applicant_id' => $applicant_id,
                                'traning_name' => $val,
                                'traning_details' => $applicant_data['training_details'][$k],
                                'created_at' => date('Y-m-d H:i:s'),
                                'status' => 'active',
                            ];

                            $this->global_model->insert('applicant_trainings', $insert_training);
                        }

                    }

            
                
                $this->db->trans_complete();

                if($this->db->trans_status() == FALSE) {
                    $this->db->trans_rollback();

                    $response = ['status' => false, 'message' => 'Registration failed!'];
                }
                else {
                    $this->db->trans_commit();

                    $response = ['status' => true, 'message' => 'Registration successfully!'];
                }
        
            }

        }

        echo json_encode($response);
        die();

    }

	

}