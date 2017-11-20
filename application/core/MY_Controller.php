<?php
/**
 * Description of MY_Controller
 *
 * @author Jayesh
 */
class MY_Controller extends CI_Controller {


    const ACTIVE = 1;
    const INACTIVE = 2;


    public function  __construct() {
        parent::__construct();
    }
    /**
     *
     * @param <array> $data
     * @param <bool> $stop
     * @return  printed array result
     */
    public function print_results($data, $stop=true) {
        echo '<pre>';
        print_r($data);
        if($stop) {
            exit;
        }
    }

    /**
     * Method to check whether user session exist
     * @return bool true or false
     */
    public function check_user_session() {
        $user_data = $this->session->userdata('user_session');
        if(!empty($user_data)) {
                redirect('dashboard/index', 'location');
        }else {
            return true;
        }
    }
   
   
    /**
     * Method to check the user session existence
     * @return  bool true
     */
    public function check_user_session_exists() {
        $user_data = $this->session->userdata('user_session');
        if(empty($user_data)) {
            redirect('login/index', 'location');
        }else {
            return true;
        }
    }
    
   
    /**
     * Method to create a random string
     * @param <integer> $length
     * @return <string> random string
     */
    public function generate_random_string($length = 16) {
        $base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
        $max=strlen($base)-1;
        $activatecode='';
        mt_srand((double)microtime()*1000000);
        while (strlen($activatecode)< $length+1) {
            $activatecode.=$base{mt_rand(0,$max)};
        }
        return $activatecode;
    }
    /**
     * Method to return user id of logged in user
     * @return <integer> user_id
     */
    public function user_id($prefix = '') {
        $user_id   = '';
        $user_data = $this->session->userdata('user_session');
        if(!empty($user_data)) {
            $user_id = $user_data[$prefix.'user_id'];
        }
        return $user_id;
    }
    /**
     * Method to return role id of logged in user
     * @return <integer> role_id
     */
    public function role_id($prefix = '') {
        $role_id   = '';
        $user_data = $this->session->userdata('user_session');
        if(!empty($user_data)) {
            $role_id = $user_data[$prefix.'role_id'];
        }
        return $role_id;
    }
    /**
     * Method to return commonm file upload file
     * @return <string> Path to upload
     */
    public function image_upload_path() {
        return  FCPATH.'public/uploads/';
    }
   

    /**
     * Method to create a random file name for uplaoding files
     * @param <string> $image
     * @return <string> unique image file name
     */
    public function create_unique_file_name($image) {
        if(!empty($image)) {
            $image       = str_replace(' ', '_', $image);
            $file_name   = str_replace(' ', '', microtime()).$image;
            $rand_name   = substr($file_name, 2, strlen($file_name));
            return $rand_name;
        }
    }
   
    /**
     * Method to return MYSQL formated date
     * @return <string>  formated date
     */
    public function current_time() {
        return date('Y-m-d H:i:s', time());
    }
    /**
     * Method to set the user data in session
     * @param <type> $data
     * @return bool true or false
     */
    public function set_user_session_data($data, $prefix = '') {
        if(!empty($data)) {
            foreach($data as $authentication_data) {
                $user_id        = $authentication_data['userid'];
                $username       = $authentication_data['username'];
               }
            $user_data      = array($prefix.'user_id'    => $user_id,
                    $prefix.'username'   => $username,
                    
            );
            $this->session->set_userdata('user_session', $user_data);
        }
    }
    
    /**
     * Method to check whether a form has been submitted or not
     * @return <bool> true or false
     */
    public function is_post() {
        return isset($_POST) && !empty($_POST) ;
    }
    
    

}

?>
