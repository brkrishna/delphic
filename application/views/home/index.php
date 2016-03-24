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
        	<p class="lead text-justify">Follow the process below to complete the required registration process.<br/>
                We will review your application and get back to you within 14 working days.<br/><br/></p>
            <br/>
            <ul class="nav nav-pills">
                <li>
                    <a href="<?php echo site_url(LOGIN_URL); ?>">
                        <button class="btn btn-primary btn-large"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Sign In</button>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('/register'); ?>">
                        <button class="btn btn-primary btn-large"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Sign Up</button>
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
                        <li>If an individual participant, then you may directly skip to the next point after <b>Registering</b>. If on a team, then the required details of the participants can be <b>Registered</b> by one of the team members</li>
                        <li>Choose a <b>Category</b> in which you or your team wants to participate/exhibit/compete</li>
                        <li>Proceed to pay the <b>Registration Fees</b>, and exit</li>
                    </ul>
                    You can keep a track of your registration process through the navigation bar on the top right corner of the page.
                    <br/><br/>
                    Once you are done, please wait to hear from our jury for the next phase of your registration process.
                </p>
                <br/>
                <p class="text-center">
                    <?php if (isset($profile_count) && $profile_count > 0) : ?>
                        <?php ($current_user_role_id == 7 ? $url = base_url() . 'index.php/admin/content/profile/edit/' . $this->session->userdata('profile_id') : $url = 'content/profile'); ?>
                        <a class="btn btn-primary" href="<?php echo ($url); ?>"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Edit Profile</a>
                    <?php else : ?>
                        <?php ($current_user_role_id == 7 ? $url = base_url() . 'index.php/admin/content/profile/create' : $url = 'content/profile'); ?>
                        <a class="btn btn-primary" href="<?php echo ($url); ?>"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Start Registration Process</a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>