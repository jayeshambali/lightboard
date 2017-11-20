<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

     public $username;
     public $password;
     public $user_id;
     


    /**
     * Constructor for the Class
     * @access public
     * @return bool true
     */
    public function  __construct() {
        parent::__construct();
        $this->template->set_template('default');
    }

    /**
     * Default method for login controller
     * @access public
     * @return boolean True or False
     */
    public function index(){
        
        $this->check_user_session();
        $this->template->write('title', 'GSN Games: User Login');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {
             
        }else{
                $this->username     = $this->input->post('username');
                $this->password     = $this->input->post('password');
                $auth               = $this->login_model->validate_user_credentials($this->username, $this->password);
                //echo "here";
                //$this->print_results($auth); exit;
                if(!$auth){
                    $this->session->set_flashdata('msg', 'The Username or Password you entered is incorrect. <br />Please try again.');
                    redirect('login/index', 'location');
                }else{
                    if(!empty($auth)){
                        $this->set_user_session_data($auth);
                        redirect('dashboard/index', 'location');
                        }else{
                             $this->session->set_flashdata('msg', 'You are not authourize to access this website');
                             redirect('login/index', 'location');
                        }
                }
        }
        $this->template->write_view('content', 'login/index');
        $this->template->render();
    }
   
    /**
     * Method to logout the user from the application
     * @access public
      * @return boolean True or False
     */
    public function logout(){
        $this->session->sess_destroy();
        redirect('login/index', 'location');
    }
    


}
?>
