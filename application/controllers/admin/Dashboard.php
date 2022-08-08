<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $_per_page = 2;

    public function __construct() {
        parent::__construct();
        $access = $this->session->userdata('user_id');
         if(!$access){
            redirect("admin/login");
        }
    }


    public function index() {
        $data = [];
        $data['page_title'] = 'Dashboard';
        $data['divisions'] 	= $this->global_model->get('divisions');
        
        // where clause params
        $params = "applicants.status = 'active' ";

        if(!empty($this->input->get())){
            if( !empty($this->input->get('applicant_name') && $this->input->get('applicant_name') != '') ){
                $params .= " AND applicants.applicant_name = '".$this->input->get('applicant_name')."' ";
            }
            if( !empty($this->input->get('applicant_email')) &&  $this->input->get('applicant_email') != ''){
                $params .= " AND applicants.applicant_email = '".$this->input->get('applicant_email')."' ";
            }
            if( !empty($this->input->get('applicant_division')) && $this->input->get('applicant_division') > 0 ){
                $params .= " AND applicants.applicant_division = '".$this->input->get('applicant_division')."' ";
            }
            if( !empty($this->input->get('applicant_district')) && $this->input->get('applicant_district') > 0 ){
                $params .= " AND applicants.applicant_district = '".$this->input->get('applicant_district')."' ";
            }
            if( !empty($this->input->get('applicant_upazila')) && $this->input->get('applicant_upazila') > 0 ){
                $params .= " AND applicants.applicant_upazila = '".$this->input->get('applicant_upazila')."' ";
            }
        }
        

        // join params
        $join_params = array(
            array(
                'table'    => 'divisions',
                'relation' => 'applicants.applicant_division=divisions.id',
                'type'     => 'left'
            ),
            array(
                'table'    => 'districts',
                'relation' => 'applicants.applicant_district=districts.id',
                'type'     => 'left'
            ),
            array(
                'table'    => 'upazilas',
                'relation' => 'applicants.applicant_upazila=upazilas.id',
                'type'     => 'left'
            )
        );
        $field_rows = 'applicants.*, applicants.id as applicant_id';
        $field_rows .= ',divisions.id,divisions.division_en';
        $field_rows .= ',districts.id,districts.district_en';
        $field_rows .= ',upazilas.id,upazilas.upazila_en';

        // pagination args
        $per_page      = $this->_per_page;
        $data['start'] = $offset = ($this->input->get('page')) ? ($per_page * ($this->input->get('page') - 1)) : 0;
        $limit_params  = array('limit' => $per_page, 'start' => $offset);

        // get total count
        $data['item_count'] = $total_rows = $this->global_model->get_count('applicants', $params, 'applicants.id', FALSE, FALSE, $join_params);

        // generate pagination
        createPagging('admin/dashboard', $total_rows, $per_page);

        
        $data['applicants'] = $this->global_model->get_join('applicants', $params, $field_rows, $limit_params, FALSE, FALSE, $join_params);
        $data['layout']     = $this->load->view('admin/registration-list',$data, true);
        $this->load->view('admin/master', $data);
    }

    public function edit_applicant($id=null){
        if(!$id){
            redirect('admin/dashboard');
        }

        $data = [];
        $data['page_title'] = "Dashboard | Edit Applicant";

        $data['divisions'] 		= $this->global_model->get('divisions');
		$data['examinations'] 	= $this->global_model->get('examinations',['status'=>'active']);
		$data['universities'] 	= $this->global_model->get('universities',['status'=>'active']);
		$data['boards']         = $this->global_model->get('boards',['status'=>'active']);
        $data['applicant']      = $applicant = $this->global_model->get_row('applicants', ['applicants.id' => $id]);

        if( $this->input->post('update_applicant') ) {

            if(!isset($_FILES['applicant_photo']) || $_FILES['applicant_photo']['error'] == UPLOAD_ERR_NO_FILE){
                $applicantPic  =  $this->input->post('old_applicant_photo',true);
            }else{
                $old_img    = $this->input->post('old_applicant_photo',true);
                $CheckPath  = base_url().'/libs/upload_pic/applicant_pic/'.$old_img;
                if(file_exists($CheckPath)):
                    unlink($CheckPath);
                endif;
                $applicantPic = $id.'_'.$this->applicant_image_upload($id);
            }
            
            if(!isset($_FILES['applicant_cv']) || $_FILES['applicant_cv']['error'] == UPLOAD_ERR_NO_FILE){
                $applicantCv  =  $this->input->post('old_applicant_cv',true);
            }else{
                $old_cv    = $this->input->post('old_applicant_cv',true);
                $CheckPath  = base_url().'/libs/upload_pic/applicant_cv/'.$old_cv;
                if(file_exists($CheckPath)):
                    unlink($CheckPath);
                endif;
                $applicantCv = $id.'_'.$this->applicant_cv_upload($id);
            }

            $applicant_update_data = [
                'applicant_name' => !empty($this->input->post('applicant_name')) ? $this->input->post('applicant_name') : $applicant->applicant_name,
                'applicant_email' => !empty($this->input->post('applicant_email')) ? $this->input->post('applicant_email') : $applicant->applicant_email,
                'applicant_division' => !empty($this->input->post('applicant_division')) ? $this->input->post('applicant_division') : $applicant->applicant_division,
                'applicant_district' => !empty($this->input->post('applicant_district')) ? $this->input->post('applicant_district') : $applicant->applicant_district,
                'applicant_upazila' => !empty($this->input->post('applicant_upazila')) ? $this->input->post('applicant_upazila') : $applicant->applicant_upazila,
                'address_details' => !empty($this->input->post('address_details')) ? $this->input->post('address_details') : $applicant->address_details,
                'language_proficiency_bangla' => !empty($this->input->post('language_proficiency_bangla')) ? $this->input->post('language_proficiency_bangla') : $applicant->language_proficiency_bangla,
                'language_proficiency_english' => $this->input->post('language_proficiency_bangla'),
                'language_proficiency_french' => $this->input->post('language_proficiency_french'),
                'applicant_photo' => $applicantPic,
                'applicant_cv' => $applicantCv,
                'is_training' => $this->input->post('is_training'),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('user_id')
            ];


            if( $this->global_model->update('applicants', $applicant_update_data, ['id' => $id] ) ) {
                $applicant_data = $this->input->post();
                $update_edu = [];
                foreach($applicant_data['applicant_exam_name'] AS $k => $val ){
                    $update_educations = [
                        'applicant_id' => $id,
                        'exam_name' => $val,
                        'university_name' => $applicant_data['applicant_university'][$k],
                        'board_name' => $applicant_data['applicant_board'][$k],
                        'result' => $applicant_data['applicant_result'][$k],
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => $this->session->userdata('user_id'),
                    ];

                    $this->global_model->update('applicant_educations', $update_educations, ['id' => $applicant_data['exam_id'][$k], 'applicant_id' => $id] );
                }

                //traning
                $update_tra = [];
                foreach($applicant_data['training_name'] AS $k => $val ){
                    $update_tra = [
                        'applicant_id' => $id,
                        'traning_name' => $val,
                        'traning_details' => $applicant_data['training_details'][$k],
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => $this->session->userdata('user_id'),
                    ];

                    $this->global_model->update('applicant_trainings', $update_tra, ['id' => $applicant_data['tra_id'][$k] ,'applicant_id' => $id]);
                }

                // set the successful message
                $this->session->set_flashdata('success_msg', 'Applicant Update Successfully.');

                redirect('admin/dashboard');

            }

        }

        $data['layout'] = $this->load->view( 'admin/edit-applicant', $data, TRUE );
        $this->load->view('admin/master', $data);


    }

    public function applicant_image_upload($id) {
        $type = explode('.', $_FILES['applicant_photo']['name']);
        $type = $type[count($type)-1];
        $file_name= uniqid(rand()).'.'.$type;

        if( in_array($type, array('jpg','jpeg' )) ){

            if( is_uploaded_file( $_FILES['applicant_photo']['tmp_name'] ) ){

                move_uploaded_file( $_FILES['applicant_photo']['tmp_name'], './libs/upload_pic/applicant_pic/'.$id.'_'.$file_name );
                return $file_name;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function applicant_cv_upload($id) {
        $type = explode('.', $_FILES['applicant_cv']['name']);
        $type = $type[count($type)-1];
        $file_name= uniqid(rand()).'.'.$type;

        if( in_array($type, array('.pdf','.doc', '.docx' )) ){

            if( is_uploaded_file( $_FILES['applicant_cv']['tmp_name'] ) ){

                move_uploaded_file( $_FILES['applicant_cv']['tmp_name'], './libs/upload_pic/applicant_cv/'.$id.'_'.$file_name );
                return $file_name;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // logout from admin panel
    public function logout() {
        
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('displayname');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level_id');

        // prd($this->session->userdata('user_id'));

        // set the successfull message and redirect
        $this->session->set_flashdata('success_msg', 'You are now logged out.');
        redirect('admin/login');
    }


}