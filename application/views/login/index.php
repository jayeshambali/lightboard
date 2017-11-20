<div class="page-inner-2">
    <div class="video">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p class="message_conatiner">
        <?php
        if ($this->session->flashdata('msg')) {
        echo  $this->session->flashdata('msg');
        }
        ?>
        </p>
    </div>
    <?php echo validation_errors('<div class="form_error">', '</div>'); ?>
    <div align="center">
        <div class="yellowBlock"  align="center">
            <?php echo form_open('login/index', array('id'=> 'login', 'name' => 'login')); ?>
            <div style="width:350px; padding-top:3px">
                <div><strong>Please login below to get started:</strong></div>
                <div style="height:10px"></div>
                <div>
                <?php
                $data  = array('id'        => 'username',
                               'name'      => 'username',
                               'maxlength' => '100',
                );
                echo form_label('Username: ', 'username');
                echo form_input($data);
                ?>
                </div>
                <div>
                <?php
                $data = array('id' => 'password',
                         'name' => 'password',
                         'maxlength' => '100'
                );
                echo form_label('Password: ', 'password');
                echo form_password($data);
                ?>
                </div>
                <div style="height:15px"></div>
                <div id="login_button">
                     <?php
               $data  = array( 'type' => 'submit',
                               'id'   => 'submit',
                               'name' => 'submit',
                               'value' => 'Login'
               );
               echo form_submit($data);
               ?>
                </div>
                <div style="height:10px"></div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>




