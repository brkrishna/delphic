<div class="span12 alert alert-info">
    Please review the below tracker to identify the progress of your registration process
</div>
<div class="stepwizard">
    <div class="stepwizard-row">
        <div class="stepwizard-step">
        <?php if (isset($profile_count) && $profile_count > 0) : ?>
            <button type="button" class="btn btn-success btn-circle">1</button>
            <?php ($current_user_role_id == 7 ? $url = 'content/profile/edit/' . $this->session->userdata('profile_id') : $url = 'content/profile'); ?>
            <p><a class="alert-link" href="<?php echo ($url); ?>">Profile</a></p>
        <?php else : ?>
            <button type="button" class="btn btn-warning btn-circle">1</button>
            <?php ($current_user_role_id == 7 ? $url = 'content/profile/create' : $url = 'content/profile'); ?>
            <p><a class="alert-link" href="<?php echo ($url); ?>">Profile</a></p>
        <?php endif; ?>
        
        </div>
        <div class="stepwizard-step">
            <?php if (isset($team_count) && $team_count > 0) : ?>
                <button type="button" class="btn btn-success btn-circle">2</button>
            <?php else : ?>
                <button type="button" class="btn btn-warning btn-circle">2</button>
            <?php endif; ?>
            <p><a class="alert-link" href="content/team">Team</a></p>
        </div>
        <div class="stepwizard-step">
            <?php if (isset($event_count) && $event_count > 0) : ?>
                <button type="button" class="btn btn-success btn-circle">3</button>
            <?php else : ?>
                <button type="button" class="btn btn-warning btn-circle">3</button>
            <?php endif; ?>
            <p><a class="alert-link" href="content/event_registration">Events</a></p>
        </div>
        <div class="stepwizard-step">
            <?php if (isset($payments) && $payments > 0) : ?>
                <button type="button" class="btn btn-success btn-circle">4</button>
            <?php else : ?>
                <button type="button" class="btn btn-warning btn-circle">4</button>
            <?php endif; ?>
            <p><a class="alert-link" href="content/factory">Payments</a></p>
        </div>
        <div class="stepwizard-step">
            <?php if (isset($artifacts) && $artifacts > 0) : ?>
                <button type="button" class="btn btn-success btn-circle">5</button>
            <?php else : ?>
                <button type="button" class="btn btn-warning btn-circle">5</button>
            <?php endif; ?>
            <p><a class="alert-link" href="content/bank_details">Artifacts</a></p>
        </div> 
    </div>
</div>
