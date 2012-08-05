<!DOCTYPE html>
<html>
    <head>
        <title><?php if(isset($page_title)){echo $page_title;}else{echo "CodeIgniter Testings";} ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo ASSETSPATH; ?>images/codeigniter.png" />
        <link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH; ?>css/theme_default.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH; ?>css/system.css" />
        <script type="text/javascript" src="<?php echo ASSETSPATH; ?>js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="<?php echo ASSETSPATH; ?>js/template.js"></script>
    </head>
    <body>
		<div id="header-wrapper">
			<div id="header">
				<div id="banner">
					<?php if(isset($appname)){echo heading($appname,1);}else{echo heading("CodeIgniter",1);} ?>
				</div>
                
				<?php if($this->session->userdata('is_login') == TRUE): { ?>
					<div id="user_menu">
						<?php $this->load->view('includes/user_menu'); ?>
					</div>
				<?php } endif; ?>
			</div>
		</div>            

        <div id="wrapper">
        
<!-- ------------------------------------------------------------------------------------------ -->

            <?php if($this->session->flashdata('message')): { ?>  
                <div id="message_box">
                    <p class="<?php echo $this->session->flashdata('css_class'); ?>">
                        <?php echo  $this->session->flashdata('message'); ?>
                    </p>
                </div>
            <?php } endif; ?>
            <?php if(isset($msg)): { ?>
                <p class="<?php echo $msg['css_class']; ?>">
                    <?php echo $msg['message']; ?>
                </p> 
                <?php unset($msg); ?>
            <?php } endif; ?>
            <?php   if(validation_errors()) : { ?>
                <div id="message_box" >
                    <?php   echo validation_errors('<p class="red_message">'); ?>
                </div>
            <?php } endif; ?>
            
<!-- ------------------------------------------------------------------------------------------ -->

             <?php if($this->session->userdata('is_login') == FALSE): { ?>
                  <?php $this->load->view($app_name. '/' .$app_view); ?>
              <?php } else : { ?>
             <table cellpadding="0" cellspacing="0"> 
                 <tr>
                     <td id="content">
                         <?php $this->load->view($app_name. '/' .$app_view); ?>
                     </td>
                      <td id="module">
                         <?php $this->load->view('includes/app_menu'); ?>
                     </td>
                 </tr>
             </table>
                 <div id="footer">
                      <?php $this->load->view('includes/footer'); ?>
                 </div>
             <?php } endif; ?>
                
        </div>
    </body>
</html>