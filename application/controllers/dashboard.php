<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    
   
    
   /**
     * Constructor for the Class
     * @access public
     * @return bool true
     */
    public function  __construct() {
        parent::__construct();
        $this->check_user_session_exists();
        $this->template->set_template('default');
    }

  /**
    * Default method for question controller that lists the questions of a  particular customer 
    * @access public
    * @return array question information as array
    */
    public function index(){
        $this->template->write('title', 'GSN Games : Light Box');

        //$this->print_results($this->data);
        $this->template->write_view('content', 'dashboard/lightbox');
        $this->template->render();
    }

    public function get_default_values(){
        $user_data  = $this->login_model->get_all_users();
        $current_user_id = $this->user_id();
        $this->print_results($user_data);
         $user_id  = '';
        if(!empty($user_data)){
            foreach($user_data as $data){
                //print_r($data);
                $lock = $data['lock'];
                $id   = $data['userid'];
                if($lock == 1){
                    $user_id  = $id;
                    break;
                }
            }
            $lit_box_string = $this->create_cells();
            
            if($user_id != ''){
                $ajax_results  = array('Lock' => 1, 'UserId' => $user_id, 'CurrentUser' => $current_user_id, 'Cells' => $lit_box_string);
            }else{
                $ajax_results  = array('Lock' => 0, 'UserId' => $user_id, 'CurrentUser' => $current_user_id, 'Cells' => $lit_box_string);
            }

        }
        echo json_encode($ajax_results);
        exit;


    }
    private function create_cells(){
        $cell_info  = $this->dashboard_model->get_all_cells();
        $lit_box_string  = '';
        if(!empty($cell_info)){
            $lit_box_string = '<tr>';
            $j =1;
            foreach($cell_info as $cells){
                $color_code = $cells['color'];
                $lit_box_string .= '<td class="cell_style jqcellcolor" id="cell-'.$j.'" style="background-color:'.$color_code.'">'.$j.'</td>';
                if($j % 10 == 0){
                    $lit_box_string .= '</tr><tr>';
                }
                $j++;
            }
        }
        return $lit_box_string;
    }
    public function unlock_user(){
        $user_data  = $this->login_model->get_all_users();
        $locked   = false;
        if(!empty($user_data)){
            foreach($user_data as $data){
                //print_r($data);
                $lock = $data['lock'];
                $id   = $data['userid'];
                if($lock == 1){
                    $user_id  = $id;
                    $locked  = true;
                    break;
                }
            }
        }
        if(!$locked){
            $user_id        = $this->user_id();
            $current_time   = date('Y-m-d h:i:s', time());
            $data           = array( 'lock'     => 1,
                                     'locktime' => $current_time);

            $this->login_model->set_user_data($user_id,$data);
        }
        $ajax_return = array('Result' => "success");
        echo json_encode($ajax_return);
        exit;
    }
    public function get_time(){
        $expired_seconds = 0;
        $user_data       = $this->login_model->get_all_users();
        $locked          = false;
        if(!empty($user_data)){
            foreach($user_data as $data){
                //print_r($data);
                $lock           = $data['lock'];
                $id             = $data['userid'];
                $locked_time    = $data['locktime'];
                if($lock == 1){
                    $user_id   = $id;
                    $lock_time = $locked_time;
                    $locked    = true;
                    break;
                }
            }
        }
        $current_user_id  = $this->user_id();
        if($locked){
            $current_time      = time();
            $seconds           = $current_time - strtotime($lock_time);

            $days    = floor($seconds / 86400);
            $hours   = floor(($seconds - ($days * 86400)) / 3600);
            $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
            $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
            if($minutes >= 1){
                $expired_seconds  = ($minutes*60)+$seconds;
            }else{
                $expired_seconds  = $seconds;
            }
            
        }else{
            $user_id = '';
            $lock    = 0;
        }
        $lit_box_string = $this->create_cells();
        if($expired_seconds < 60){
            $ajax_results  = array('Lock' => $lock, 'UserId' => $user_id, 'CurrentUser' => $current_user_id, 'Seconds' => $expired_seconds, 'Cells' => $lit_box_string);
        }else{  //release the lock for all users
            $data  = array('lock' => 0);
            $this->login_model->set_user_data($user_id, $data);
            $ajax_results  = array('Result' => 'No', 'Lock' => $lock, 'UserId' => $user_id,'CurrentUser' => $current_user_id, 'Cells' => $lit_box_string);
        }
        echo json_encode($ajax_results);
        exit;
        
        
    }
    public function color_the_cell(){
        $error     = false;
        $color     = 'White';
        $cell_id   = $this->input->post('cellid');
        if($cell_id > 0){
            $current_user_id   = $this->user_id();
            $user_info   = $this->login_model->get_user_by_id($current_user_id);
            //$this->print_results($user_info);
            if(!empty($user_info)){
                $lock   = $user_info['lock'];
                if($lock == 1){
                    $cell_info  = $this->dashboard_model->get_cell_by_id($cell_id);
                    if(!empty($cell_info)){
                        $current_cell_color  = $cell_info['color'];
                    }
                    if($current_cell_color == '#ffffff'){
                        if($current_user_id == 1){
                            $color = '#ff0000';
                        }else if($current_user_id ==2){
                            $color = '#ffff00';
                        }
                    }else{
                        $color = '#ffffff';
                    }
                    // change the cell information
                    $data  = array('userid' => $current_user_id,
                                   'color'  => $color
                        );
                    $this->dashboard_model->set_cell_data($cell_id,$data);
                    //release the lock
                    $data  = array('lock' => 0);
                    
                    $this->login_model->set_user_data($current_user_id,$data);
                    

                }else{
                    $error    = true;
                    $message  = 'Please get the lock before lit the cell';
                }
            }

        }else{
            $error  = true;
            $message  = 'Something went wrong, please try again later';
        }
        if($error){
            $result = 'Fail';
            $message = $message;
        }else{
            $result  = 'Success';
            $message = '';
        }
        $ajax_results  = array('Result' => $result, 'Message' => $message, 'Color' => $color);
        echo json_encode($ajax_results);
        exit;
        
    }
    
   
    
}
?>
