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
    <div class="jumbotron" text-align="center">
    	<h1>Welcome to <br/>V Youth Delphic Registrations</h1>
        <hr/>
    	<p class="lead">Register and follow through the process to complete necessary documentation, 
    	<br/>
    	sit back and relax while we review the application and get back to you.<br/>That's all folks.</p>
    
    </div>
<?php else : ?>
   <div class="row-fluid">
        <ul class="nav nav-pills">
            <?php echo Modules::run('profile/profile_status'); ?>
        </ul>
   </div>
    <div class="row-fluid">
        <div class="col-md-10">
            <p class="text-justify">
                The aim of this guide is to assist participants in registering with the games. The mandatory registration standards are listed below.
                <ul>
                    <li>One member from a team/group will register on behalf of the rest of the team.</li>
                    <li>Participants are required to upload following documents:
                        <ul>
                            <li>Zip folder of Passport copies of all Members ( Mandatory)</li>
                            <li>Bona Fide, Institutional Acknowledgement (if applicable)</li>
                            <li>Acknowledgement letter (if applicable)</li>
                            <li>Performance video, link, photos, certificates of past performances. (whatever is available)</li>
                        </ul>
                    </li>
                    <li>The Registration requires the participants to fill in their personal details in the required fields whichever are marked mandatory that includes country name, name, e-mail id, contact number, passport number, address, date of expiry of passport, country issuing passport etc.</li>
                    <li>Expiry date of passport should be more than 6 months.</li>
                    <li>Mandatory Documents primarily includes Front and Back copy of the Passport of the participant. Passport Document is not mandatory if the participation is from the host country (India). Participation coming from Host Country are required to upload one identify proof document.</li>
                    <li>If the participants are coming from an Institute, College, NGO , NDA, School or any other organisation the candidates are supposed to provide a copy of the institutional certificate (Bona fide, Institutional Acknowledgement).</li>
                    <li>Participants under 18 years of age are required to submit an Acknowledgement Letter from the Parents/Guardian, accepting the terms and conditions of the participation.</li>
                    <li>Participants are required to upload, documented proof of the respective talent. Artist's profile. Links for the videos, Audio Visuals (Video and Photographs) can be uploaded. Certificates and Photos of the documents can be uploaded in JPEG, PNG, PDF formats.</li>
                    <li>Registration and Insurance are inclusive, the fees can be paid through the following
                        <ul>
                            <li>Payment methods :</li>
                            <li>Credit Card</li>
                            <li>Debit Card</li>
                            <li>Net Banking</li>
                        </ul>
                    </li>
                    </li>Participants are requested to go through Rules & Regulations before proceeding.</li>
                </ul>
            </p>
        </div>
    </div>
<?php endif; ?>