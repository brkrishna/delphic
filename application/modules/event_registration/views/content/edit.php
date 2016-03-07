<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('event_registration_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($event_registration->id) ? $event_registration->id : '';

?>
<div class='row'>
    <hr/>
    <h4>Event Details</h4>
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                 <?php if (is_array($categories_select) && count($categories_select)) :
                    echo form_dropdown(array('class'=>'form-control', 'id'=>'category', 'name'=>'category', 'disabled'=>'true'), $categories_select, set_value('category', isset($event_registration->category) ? $event_registration->category : ''), 'Category'. lang('bf_form_label_required'), "tabindex='1'");
                endif; ?>
            </div>    
            <div class="form-group">
                <?php if (is_array($style_select) && count($style_select)) :
                        echo form_dropdown(array('class'=>'form-control', 'id'=>'style', 'name'=>'style', 'disabled'=>'true'), $style_select, set_value('style', isset($event_registration->style) ? $event_registration->style : ''), 'Style'. lang('bf_form_label_required'), "tabindex='2'");
                    endif; ?>
            </div>    
            <div class="form-group">
                <?php if (is_array($performance_select) && count($performance_select)) :
                        echo form_dropdown(array('class'=>'form-control', 'id'=>'performance', 'name'=>'performance','disabled'=>'true'), $performance_select, set_value('category', isset($event_registration->performance) ? $event_registration->performance : ''), 'Performance'. lang('bf_form_label_required'), "tabindex='3'");
                    endif; ?>
            </div>
            <h4>Assign Participants</h4>
            <div class="form-group">
                <?php  if (is_array($teams_select) && count($teams_select)) :
                        $participants = unserialize($event_registration->team);
                        echo form_dropdown(array('class'=>'form-control', 'id'=>'team[]', 'name'=>'team[]', 'multiple'=>'multiple'), $teams_select, set_value('team', isset($participants) ? $participants : ''), 'Team'. lang('bf_form_label_required'), "tabindex='1'");
                endif; ?>
            </div>
            <div class="form-group<?php echo form_error('notes') ? ' error' : ''; ?>">
                <?php echo form_label(lang('event_registration_field_notes'), 'notes', array('class' => 'control-label')); ?>
                <?php echo form_textarea(array('name' => 'notes', 'id' => 'notes', 'rows' => '5', 'cols' => '80', 'value' => set_value('notes', isset($event_registration->notes) ? $event_registration->notes : ''))); ?>
                <span class='help-inline'><?php echo form_error('notes'); ?></span>
            </div>

            <h4>Upload Documents</h4>


            <div class="form-group<?php echo form_error('attach_1') ? ' error' : ''; ?>">
                <?php echo form_label(lang('event_registration_field_attach_1'), 'attach_1', array('class' => 'control-label')); ?>
                <?php if(isset($event_registration->attach_1)) : ?>
                    <?php echo(isset($event_registration->attach_1) ? anchor(base_url() . 'uploads/' . unserialize($event_registration->attach_1)['file_name'], unserialize($event_registration->attach_1)['file_name']) : ''); ?>
                <?php endif; ?>
                <div class='controls'>
                    <input class="btn btn-primary" id='attach_1' type='file' name='attach_1' multiple maxlength='4000' value="<?php echo set_value('attach_1', isset($event_registration->attach_1) ? $event_registration->attach_1 : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('attach_1'); ?></span>
                </div>
            </div>


            <div class="form-group<?php echo form_error('attach_2') ? ' error' : ''; ?>">
                <?php echo form_label(lang('event_registration_field_attach_2'), 'attach_2', array('class' => 'control-label')); ?>
                <?php if(isset($event_registration->attach_2)) : ?>
                    <?php echo(isset($event_registration->attach_2) ? anchor(base_url() . 'uploads/' . unserialize($event_registration->attach_2)['file_name'], unserialize($event_registration->attach_2)['file_name']) : ''); ?>
                <?php endif; ?>
                <div class='controls'>
                    <input class="btn btn-primary" id='attach_2' type='file' name='attach_2' maxlength='4000' value="<?php echo set_value('attach_2', isset($event_registration->attach_2) ? $event_registration->attach_2 : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('attach_2'); ?></span>
                </div>
            </div>


            <div class="form-group<?php echo form_error('attach_3') ? ' error' : ''; ?>">
                <?php echo form_label(lang('event_registration_field_attach_3'), 'attach_3', array('class' => 'control-label')); ?>
                <?php if(isset($event_registration->attach_3)) : ?>
                    <?php echo(isset($event_registration->attach_3) ? anchor(base_url() . 'uploads/' . unserialize($event_registration->attach_3)['file_name'], unserialize($event_registration->attach_3)['file_name']) : ''); ?>
                <?php endif; ?>
                <div class='controls'>
                    <input class="btn btn-primary" id='attach_3' type='file' name='attach_3' maxlength='4000' value="<?php echo set_value('attach_3', isset($event_registration->attach_3) ? $event_registration->attach_3 : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('attach_3'); ?></span>
                </div>
            </div>


            <div class="form-group<?php echo form_error('attach_4') ? ' error' : ''; ?>">
                <?php echo form_label(lang('event_registration_field_attach_4'), 'attach_4', array('class' => 'control-label')); ?>
                <?php if(isset($event_registration->attach_4)) : ?>
                    <?php echo(isset($event_registration->attach_4) ? anchor(base_url() . 'uploads/' . unserialize($event_registration->attach_4)['file_name'], unserialize($event_registration->attach_4)['file_name']) : ''); ?>
                <?php endif; ?>
                <div class='controls'>
                    <input class="btn btn-primary" id='attach_4' type='file' name='attach_4' maxlength='4000' value="<?php echo set_value('attach_4', isset($event_registration->attach_4) ? $event_registration->attach_4 : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('attach_4'); ?></span>
                </div>
            </div>


            <div class="form-group<?php echo form_error('attach_5') ? ' error' : ''; ?>">
                <?php echo form_label(lang('event_registration_field_attach_5'), 'attach_1', array('class' => 'control-label')); ?>
                <?php if(isset($event_registration->attach_5)) : ?>
                    <?php echo(isset($event_registration->attach_5) ? anchor(base_url() . 'uploads/' . unserialize($event_registration->attach_5)['file_name'], unserialize($event_registration->attach_5)['file_name']) : ''); ?>
                <?php endif; ?>
                <div class='controls'>
                    <input class="btn btn-primary" id='attach_5' type='file' name='attach_5' maxlength='4000' value="<?php echo set_value('attach_5', isset($event_registration->attach_5) ? $event_registration->attach_5 : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('attach_5'); ?></span>
                </div>
            </div>

            <div class='form-group'>
                <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('event_registration_action_create'); ?>" />
                <?php echo lang('bf_or'); ?>
                <?php echo anchor(SITE_AREA . '/content/event_registration', lang('event_registration_cancel'), 'class="btn btn-warning"'); ?>
                
            </div>
        </div>
    <?php echo form_close(); ?>
    <div class="col-xs-12 col-sm-10 col-md-6">
        <div class="well well-lg">
            <p class="text-justify">
                <h2>What is this Event Registration?</h2>
                <hr/>
                To enroll for an event and indicate your participants (team members) and showcase your artifacts (as document attachments) to 
                substantiate your application 
                <br/><br/>
                Steps involved
                <ul>    
                    <li>Click on Add Event</li>
                    <li>Choose the Art Category, Style and Performance, add any additional information</li>
                    <li>Select one or multiple team members</li>
                    <li>Attach documents substantiate your application</li>
                </ul>
            </p>
        </div>
    </div>

</div>