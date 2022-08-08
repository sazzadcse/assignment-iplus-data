<?php

// check admin user login return true or false
if(!function_exists('check_admin_login')) {

    function check_admin_login() {
        // create instance
        $CI = &get_instance();

        if($CI->session->developerCheck == FALSE) {
            //redirect('down');
        }

        // check user data on session
        if((!$CI->session->user_id)) {
            return FALSE;
        }

        $user_id = $CI->session->user_id;

        // get the specific user information
        $user = $CI->global_model->get_row('users', array('user_id' => $user_id));

        // if found then set the user data to the session
        if(!$user) {
            return FALSE;
        }

        if($user->status == 0) {
            return FALSE;
        }

        if($user->level_id != 4) {
            //redirect('down');
        }


        return TRUE;
    }

    // create paggination configuratin
if(!function_exists('createPagging')) {

    function createPagging($page_url, $total_rows, $per_page, $num_links = 2) {
        $CI = &get_instance();
        //load the pagging library
        $CI->load->library('pagination');
        // set the configuration
        $config['base_url']   = site_url($page_url);
        $config['total_rows'] = $total_rows;
        $config['per_page']   = $per_page;
        $config['num_links']  = $num_links;

        $config['page_query_string']    = TRUE;
        $config['reuse_query_string']   = TRUE;
        $config['query_string_segment'] = 'page';
        $config['use_page_numbers']     = TRUE;

        // pagging design section
        //full tag
        $config['full_tag_open']  = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';

        // first tag
        $config['first_link']      = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        //Last Link
        $config['last_link']      = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
        $config['last_tag_open']  = '<li>';
        $config['last_tag_close'] = '</li>';

        //“Next” Link
        $config['next_link']      = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
        $config['next_tag_open']  = '<li>';
        $config['next_tag_close'] = '</li>';

        //"privious" link
        $config['prev_link']      = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
        $config['prev_tag_open']  = '<li>';
        $config['prev_tag_close'] = '</li>';


        //"Current Page" Link
        $config['cur_tag_open']  = '<li class = "active"><a href = "javascript:void(0)">';
        $config['cur_tag_close'] = '</a></li>';

        // "Digit" Link
        $config['num_tag_open']  = '<li>';
        $config['num_tag_close'] = '</li>';

        // Produces: class="myclass"
        //        $config['attributes'] = array('class' => 'page-link next_page');


        $CI->pagination->initialize($config);
    }
}


    if(!function_exists('get_districs_by_division')) {
        function get_districs_by_division($id) {
            $CI = &get_instance();
            $districts = [];
            if(!empty($id)){
                $districts = $CI->global_model->get('districts', ['division_id' => $id]);
            }
            return $districts;
        }
    }
    
    if(!function_exists('get_upazilas_by_district')) {
        function get_upazilas_by_district($id) {
            $CI = &get_instance();
            $upazilas = [];
            if(!empty($id)){
                $upazilas = $CI->global_model->get('upazilas', ['district_id' => $id]);
            }
            return $upazilas;
        }
    }
    
    if(!function_exists('get_applicant_education_by_id')) {
        function get_applicant_education_by_id($id) {
            $CI = &get_instance();
            $educations = [];
            if(!empty($id)){
                $educations = $CI->global_model->get('applicant_educations', ['applicant_id' => $id]);
            }
            return $educations;
        }
    }
    
    if(!function_exists('get_applicant_trainings_by_id')) {
        function get_applicant_trainings_by_id($id) {
            $CI = &get_instance();
            $trainings = [];
            if(!empty($id)){
                $trainings = $CI->global_model->get('applicant_trainings', ['applicant_id' => $id]);
            }
            return $trainings;
        }
    }
    
    if(!function_exists('prd')) {
        function prd($data) {
            echo '<pre>';
            print_r( $data );
            echo '</pre>';
            die();
        }
    }

}
