<?php
/**
 * BuddyPress - Members Activate
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div id="buddypress">
    <div class="bbp-container bbp-padder">

	<?php

	/**
	 * Fires before the display of the member activation page.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_activation_page' ); ?>

	<div class="page" id="activate-page">

		<?php

		/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
		do_action( 'template_notices' ); ?>

		<?php

		/**
		 * Fires before the display of the member activation page content.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_before_activate_content' ); ?>

		<?php if ( bp_account_was_activated() ) : ?>

			<?php if ( isset( $_GET['e'] ) ) : ?>
				<p><?php _e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'buddypress' ); ?></p>
			<?php else : ?>
				<p><?php printf( __( 'Your account was activated successfully! You can now <a href="%s" class="js-authentication">log in</a> with the username and password you provided when you signed up.', 'boombox' ), esc_url('#sign-in') ); ?></p>
			<?php endif; ?>

		<?php else : ?>

			<h3 class="header-txt"><?php _e( 'Please provide a valid activation key.', 'buddypress' ); ?></h3>

			<form action="" method="get" class="standard-form bb-form-block" id="activation-form">
				<div class="input-field"><input type="text" name="key" id="key" placeholder="<?php _e( 'Activation Key', 'buddypress' ); ?>" value="<?php echo esc_attr( bp_get_current_activation_key() ); ?>" /></div>
				<input type="submit" name="submit" value="<?php esc_attr_e( 'Activate', 'buddypress' ); ?>" class="button" />
			</form>

		<?php endif; ?>

		<?php

		/**
		 * Fires after the display of the member activation page content.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_after_activate_content' ); ?>

	</div><!-- .page -->

	<?php

	/**
	 * Fires after the display of the member activation page.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_activation_page' ); ?>
    </div><!-- .bbp-container -->
</div><!-- #buddypress -->
