<!--<!DOCTYPE html>
<html>
    <head>
        <title><?php if(isset($page_title)){echo $page_title;}else{echo "CodeIgniter Notebook";} ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH; ?>css/system.css" />
    </head>
    <body>
        <div id="wrapper">-->
        <div style="text-align:center;">
            <div style="margin:0 auto;text-align:left;width:800px;">
            
            <div  style="float:left;width:360px;padding:0 20px 0 20px;">
            <?php    echo heading('Login',3); ?>
                <form action="<?php echo site_url("user/login/"); ?>" method="post">
                    <div style="width:140px;float:left;"><label for="username">Username : : </label></div>
                    <input type="text" style="width:180px;" name="username" /><br /><br />
                    <div style="width:140px;float:left;"><label for="password">Password&nbsp; : : </label></div>
                    <input type="password" style="width:180px;" name="password"><br /><br />
                    <input type="submit" value="Login">
                </form>
            </div>
            <div style="float:left;width:380px;padding:0 10px 0 10px;">
            <?php     echo heading('Register',3); ?>
                <form action="<?php echo site_url("user_register/register/"); ?>" method="post">
                    <div style="width:160px;float:left;"><label for="username">Username : : </label></div>
                    <input type="text" style="width:200px;" name="username" /><br /><br />
                    <div style="width:160px;float:left;"><label for="password">Password : : </label></div>
                    <input type="password" style="width:200px;" name="password"><br /><br />
                    <div style="width:160px;float:left;"><label for="password2">Confirm Password : : </label></div>
                    <input type="password" style="width:200px;" name="password2"><br /><br />
                    <div style="width:160px;float:left;"><label for="email">Email : :</label></div>
                    <input type="text" style="width:200px;" name="email"><br /><br />
                    <div style="width:160px;float:left;"><label for="fullname">Full Name : :</label></div>
                    <input type="text" style="width:200px;" name="fullname"><br /><br />
                    <input type="submit" value="Register">
                </form>
            </div>
            
        </div>
   <!-- </div>
    </body>
</html>-->