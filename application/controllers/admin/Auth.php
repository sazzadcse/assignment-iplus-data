<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


    public $_module = 'auth';
    public $_module_name = 'Auth';

    public function __construct() {
        parent::__construct();
        $access = $this->session->userdata('user_id');
         if($access){
            redirect("admin/dashboard");
        }
    }

    public function login() {
        $data = array();
        $data['page_title'] = 'Login';

        // check if click on the submit button
        if ($this->input->post('submit_login')) {
            
            $this->form_validation->set_rules('login_name', 'User Name or Email Address ', 'trim|required')
                    ->set_rules('password', 'Password', 'trim|required')
            ;

            if ($this->form_validation->run()) {
                $params = "`email` = '" . $this->input->post('login_name') . "' OR `user_name`='" . $this->input->post('login_name') . "'";

                // get the dta from database using user_name
                $user = $this->global_model->get_row('users', $params);
                $password = md5($this->input->post('password'));
                // check if any data found or not
                if ($user) {
                    if ( $password == $user->password) {
                        if ($user->status == 1) {
                            $user_data = array(
                                'user_id' => $user->user_id,
                                'user_name' => $user->user_name,
                                'displayname' => $user->displayname,
                                'email' => $user->email,
                                'level_id' => $user->level_id,
                            );
                            $this->session->set_userdata($user_data);

                            // set the successful message
                            $this->session->set_flashdata('success_msg', 'You have successfully logged in.');

                            redirect('admin/dashboard');

                        } else {
                            $data['error_msg'] = "Your account may inactive/disable";
                        }
                    } else {
                        $data['error_msg'] = "Password is incorrect try again";
                    }
                } else {
                    $data['error_msg'] = "User Name or Email Address is incorrect try again";
                }
            }
        }

        // load the view page for login
        $this->load->view('admin/login', $data);
    }

    

    // logout from admin panel
    public function logout() {
        
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('displayname');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level_id');

        prd($this->session->userdata('user_id'));

        // set the successfull message and redirect
        $this->session->set_flashdata('success_msg', 'You are now logged out.');
        redirect('admin/login');
    }

}