<?php
$has_profile	= isset($profile) && is_array($profile) && count($profile);
$has_registrations = isset($registrations) && is_array($registrations) && count($registrations);
?>
<div class='row'>
<!--    <span class="pull-center"><strong>Invoice</strong></span>
    <hr/>
	<table class='table table-bordered table-condensed'>
		<thead>
			<tr>
			    <td colspan="2">
                    <?php if ($has_profile) :
                        foreach($profile as $prof) :
                            e($prof->entity_name);
                            echo('<br/>');
                            e($prof->contact_name);
                            echo('<br/>');
                            e($prof->address . ', ' . $prof->city);
                            echo('<br/>');
                            e($prof->country . ', ' . $prof->post_code);
                            echo('<br/>');
                            e($prof->contact_number . ', ' . $prof->email_id);
                        endforeach;
                    endif; ?>			        
			    </td>
                <td colspan="3" class="text-right"><?php e(date('d M Y')); ?></td>
			</tr>
		</thead>
        <tr><td colspan="5"><br/><br/></td></tr>
			<tr><th>Category</th><th>Style</th><th>Performance</th><th>Participant</th><td align="right"><strong>Amount (in USD)</strong></td></tr>
			<?php if ($has_registrations) :
			    $total = 0;
			    foreach($registrations as $regn) :
            ?>
                <tr>
                    <td><?php e($regn->category); ?> </td>
                    <td><?php e($regn->style); ?> </td>
                    <td><?php e($regn->performance); ?> </td>
                    <td><?php e($regn->member_name); ?> </td>
                    <td align="right"><?php e(number_format($regn->member_name == '' ? 0.00 : 11.00, 2)); ?> </td>
                </tr>
            <?php
                    if ($regn->member_name != ''):
                        $total += 11;
                    endif;
			    endforeach;
			?>
		<tfooter>
		    <tr><td colspan="4" >Total</td><td align="right"><?php e(number_format($total, 2)); ?></td></tr>
		</tfooter>
		<?php endif; ?>
	</table>
    <p>
        <div class="form-group">
            <?php echo anchor(base_url() . 'index.php/admin/content/rnrack/create', 'Continue to Payment', array('class'=>'btn btn-primary', 'tabindex'=>'1')); ?> 
        </div>
    </p>
    <hr/>-->
    <p class="alert alert-info">We will get back to you via email shortly for registration fees</p>
</div>