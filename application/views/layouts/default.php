<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <?php
        $link = array('href'  => 'public/css/style.css','rel'=> 'stylesheet','type'  => 'text/css');
        echo link_tag($link);
        echo $_styles;
        ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.js"></script>
        <script  type="text/javascript" src="<?php echo base_url(); ?>public/js/common.js"></script>
        <?php echo $_scripts; ?>
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
        <script type="text/javascript" >
            var base_url = '<?php echo base_url(); ?>';
        </script>
    </head>
    <body>
        <div id="header" >
            <div class="link_style"><?php
                $user_session = $this->session->userdata('user_session');
                if(!empty($user_session)) {
                    ?>

                    <?php echo anchor( 'login/logout/', 'Logout&nbsp;('.ucfirst($user_session['username']).')') ?>
                    <?php
                }
                ?>
            </div>
        </div>
        <div id="page">
            <?php echo $content; ?>
        </div>
        <div id="footer">
            <p align ="center">Copyright &copy; test app jayesh ambali</p>
        </div>
    </body>
</html>