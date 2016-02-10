<?php 
    $profile_id = NULL;
    if (!empty($current_user)){
        if ($current_user->role_id == 7)
        {
            $this->load->model('profile_users/profile_users_model');
            $profile_id = $this->profile_users_model->get_profile_id($current_user->id);    
            $profile_id = ($profile_id > 0 ? $profile_id : -1);
            $this->session->set_userdata('profile_id',$profile_id);
        }
    }
?>

<?php if (empty($current_user)) : ?>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-10" text-align="center">
        	<h1>V Youth Delphic Games</h1>
            <br/>
        	<p class="lead text-justify">Register and follow through the process to complete necessary documentation, sit back and 
            relax while we review the application and get back to you.<br/><br/><i>That's all folks.</i></p>
            <br/>
            <ul class="nav nav-pills">
                <li>
                    <a href="<?php echo site_url(LOGIN_URL); ?>">
                        <button class="btn btn-primary btn-large"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Sign</button>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('/register'); ?>">
                        <button class="btn btn-primary btn-large"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Register</button>
                    </a>
                </li>
            </ul>
        </div>
    </div>

<?php else : ?>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-12 text-justify">
            <p class="text-right">
                <span>
                    <a class="btn btn-primary" href="http://www.youthdelphicgames.com/downloads/Rules%20and%20Regulations.pdf"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;Rules and Regulations</a>&nbsp;
                    <a class="btn btn-primary" href="http://www.youthdelphicgames.com/downloads/Registration%20Guidelines.pdf"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;Registration Guidelines</a>
                </span>
            </p>
            <div class="well well-lg">
                <p class="text-justify">
                    <h2>Registration Process - How it works</h2>
                    <hr/>
                    This is a four step process: 
                    <ul>
                        <li>Create your <strong>Profile</strong></li>
                        <li>Setup your <strong>team</strong>, members who will participate in the event</li>
                        <li>Register for <strong>Event(s)</strong></li>
                        <li>Pay the Registration <strong>Fees</strong>, after reading through the Rules and Regulations</li>
                    </ul>
                    You can follow through the navigation buttons on top right for completing the registration process. A button with green color text indicates that you have completed the step and a button in orange needs your attention
                    <br/><br/>
                    Once you are done, please wait to hear from our jury for next steps and you can come back to check the status of your application
                    <br/><br/>
                    If your application is approved, you will hear on next steps, detailed schedule from us
                    <br/>OR<br/>
                    If your application is not approved, we will get back with detailed email on why you couldn't make it this time
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>