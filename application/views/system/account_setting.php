<script type="text/javascript">
    var i_slider = jQuery.noConflict();
    i_slider(document).ready(function(){
        //i_slider(".jqslide_body").hide();
        i_slider(".jqslide_head").click(function(){
            i_slider(this).next(".jqslide_body").slideToggle(500);
            return true;
        });
    });
</script>
<script type="text/javascript">
    function update(){
        var form = document.account_setting;
        form.submit();
        return true;
    }
</script>

<form name="account_setting" action="<?php echo site_url("user/account_setting");?>" method="post" enctype="multipart/form-data">
<div class="jqslide_head">
      User Informations                                    
</div>
<div class="jqslide_body" style="display:block;">
      <div style="float:left;width:180px;">Username :: </div><?php echo $content['username']; ?><br />
      <div style="float:left;width:180px;">Email :: </div><?php echo $content['email']; ?><br />
      <div style="float:left;width:180px;">Full Name :: </div><?php echo $content['fullname']; ?><br />
      <div style="float:left;width:180px;">Timezone :: </div><?php echo timezoneref_to_human($content['time_zone']); ?><br />
      <div style="float:left;width:180px;">Current Date & Time :: </div><?php echo unix_to_human(gmt_to_local(now(),$content['time_zone'],FALSE),FALSE,'us') ?><br />
      <div style="float:left;width:180px;">User Since :: </div><?php echo unix_to_human(gmt_to_local($content['join_time'],$content['time_zone'],FALSE),FALSE,'us'); ?><br />
</div>

<div class="jqslide_head">
      Change Password
</div>
<div class="jqslide_body">
    <div style="float:left;width:200px;">Old Password : :</div><input type="password" style="width:220px;" name="o_password"><br />
    <div style="float:left;width:200px;">New Passord : : </div><input type="password" style="width:220px;" name="password"><br />
    <div style="float:left;width:200px;">Confirm New Password : : </div><input type="password" style="width:220px;" name="password2"><br /> 
</div>

<div class="jqslide_head">
      Change Email
</div>
<div class="jqslide_body">
    <div style="float:left;width:200px;">New Email : : </div><input type="text" style="width:220px;" name="email">
</div>

<div class="jqslide_head">
      Change Full Name
</div>
<div class="jqslide_body">
     <div style="float:left;width:200px;">New Full Name : : </div><input type="text" style="width:220px;" name="fullname">
</div>

<div class="jqslide_head">
      Change Time Zone
</div>
<div class="jqslide_body">
    <p style="text-decoration:underline;margin:4px 0 4px 0;">Change Timezone</p> 
    <?php echo timezone_menu($content['time_zone'],'','time_zone'); ?>
</div>
<br />
<input type="hidden" name="task" value="update" onClick="update()"> 
<input type="button" value="Save Changes" onClick="update()">
</form>