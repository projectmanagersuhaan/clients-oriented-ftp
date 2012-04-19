<?php
/**
 * Contains the form that is used when adding or editing clients.
 *
 * @package		ProjectSend
 @ @subpackage	Clients
 *
 */
?>

<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function() {
			clean_form(this);

				is_complete(this.add_client_form_name,'<?php echo $validation_no_name; ?>');
				is_complete(this.add_client_form_user,'<?php echo $validation_no_user; ?>');
				is_complete(this.add_client_form_email,'<?php echo $validation_no_email; ?>');
				is_length(this.add_client_form_user,<?php echo MIN_USER_CHARS; ?>,<?php echo MAX_USER_CHARS; ?>,'<?php echo $validation_length_user; ?>');
				is_email(this.add_client_form_email,'<?php echo $validation_invalid_mail; ?>');
				is_alpha(this.add_client_form_user,'<?php echo $validation_alpha_user; ?>');
			
			<?php
				/**
				 * Password validation is optional only when editing a client.
				 */
				if ($clients_form_type == 'edit_client') {
			?>
					// Only check password if any of the 2 fields is completed
					var password_1 = $("#add_client_form_pass").val();
					var password_2 = $("#add_client_form_pass2").val();
					if ($.trim(password_1).length > 0 || $.trim(password_2).length > 0) {
			<?php
				}
			?>

						is_complete(this.add_client_form_pass,'<?php echo $validation_no_pass; ?>');
						is_complete(this.add_client_form_pass2,'<?php echo $validation_no_pass2; ?>');
						is_length(this.add_client_form_pass,<?php echo MIN_PASS_CHARS; ?>,<?php echo MAX_PASS_CHARS; ?>,'<?php echo $validation_length_pass; ?>');
						is_password(this.add_client_form_pass,'<?php $chars = addslashes($validation_valid_chars); echo $validation_valid_pass." ".$chars; ?>');
						is_match(this.add_client_form_pass,this.add_client_form_pass2,'<?php echo $validation_match_pass; ?>');

			<?php
				/** Close the jquery IF statement. */
				if ($clients_form_type == 'edit_client') {
			?>
					}
			<?php
				}
			?>

			// show the errors or continue if everything is ok
			if (show_form_errors() == false) { return false; }
		});
	});
</script>

<?php
switch ($clients_form_type) {
	case 'new_client':
		$submit_value = __('Add client','cftp_admin');
		$disable_user = false;
		$form_action = 'clients-add.php';
		break;
	case 'edit_client':
		$submit_value = __('Save client','cftp_admin');
		$disable_user = true;
		$form_action = 'clients-edit.php?id='.$client_id;
		break;
}
?>

<form action="<?php echo $form_action; ?>" name="addclient" method="post">
	<ul class="form_fields">
		<li>
			<label for="add_client_form_name"><?php _e('Name','cftp_admin'); ?></label>
			<input name="add_client_form_name" id="add_client_form_name" class="txtfield required" value="<?php echo (isset($add_client_data_name)) ? stripslashes($add_client_data_name) : ''; ?>" />
		</li>
		<li>
			<label for="add_client_form_user"><?php _e('Log in username','cftp_admin'); ?></label>
			<input name="add_client_form_user" id="add_client_form_user" class="txtfield <?php if (!$disable_user) { echo 'required'; } ?>" maxlength="<?php echo MAX_USER_CHARS; ?>" value="<?php echo (isset($add_client_data_user)) ? stripslashes($add_client_data_user) : ''; ?>" <?php if ($disable_user) { echo 'readonly'; }?> />
		</li>
		<li>
			<label for="add_client_form_pass"><?php _e('Password','cftp_admin'); ?></label>
			<input name="add_client_form_pass" id="add_client_form_pass" class="txtfield required" type="password" maxlength="<?php echo MAX_PASS_CHARS; ?>" />
		</li>
		<li>
			<label for="add_client_form_pass2"><?php _e('Repeat password','cftp_admin'); ?></label>
			<input name="add_client_form_pass2" id="add_client_form_pass2" class="txtfield required" type="password" maxlength="<?php echo MAX_PASS_CHARS; ?>" />
		</li>
		<li>
			<label for="add_client_form_address"><?php _e('Address','cftp_admin'); ?></label>
			<input name="add_client_form_address" id="add_client_form_address" class="txtfield" value="<?php echo (isset($add_client_data_addr)) ? stripslashes($add_client_data_addr) : ''; ?>" />
		</li>
		<li>
			<label for="add_client_form_phone"><?php _e('Telephone','cftp_admin'); ?></label>
			<input name="add_client_form_phone" id="add_client_form_phone" class="txtfield" value="<?php echo (isset($add_client_data_phone)) ? stripslashes($add_client_data_phone) : ''; ?>" />
		</li>
		<li>
			<label for="add_client_form_email"><?php _e('E-mail','cftp_admin'); ?></label>
			<input name="add_client_form_email" id="add_client_form_email" class="txtfield required" value="<?php echo (isset($add_client_data_email)) ? stripslashes($add_client_data_email) : ''; ?>" />
		</li>
		<li>
			<label for="add_client_form_notify"><?php _e('Notify new uploads by e-mail','cftp_admin'); ?></label>
			<input type="checkbox" name="add_client_form_notify" id="add_client_form_notify" <?php echo (isset($add_client_data_notity) && $add_client_data_notity == 1) ? 'checked="checked"' : ''; ?> />
		</li>
		<li>
			<label for="add_client_form_intcont"><?php _e('Internal contact','cftp_admin'); ?></label>
			<input name="add_client_form_intcont" id="add_client_form_intcont" class="txtfield" value="<?php echo (isset($add_client_data_intcont)) ? stripslashes($add_client_data_intcont) : ''; ?>" />
		</li>
		<li class="form_submit_li">
			<input type="submit" name="Submit" value="<?php echo $submit_value; ?>" class="button button_blue button_submit" />
		</li>
	</ul>

	<?php
		if ($clients_form_type == 'new_client') {
			$msg = __('This account information will be e-mailed to the address supplied above','cftp_admin');
			echo system_message('info',$msg);
		}
	?>
</form>