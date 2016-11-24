<?php settings_errors(); ?>
<form method="POST" class="theme-option-form" action="options.php">
	<?php do_settings_sections('theme_options'); ?>
	<?php settings_fields('theme-options-settings-group'); ?>
	<?php submit_button('Update' , 'primary' , 'btnSubmit'); ?>
</form>