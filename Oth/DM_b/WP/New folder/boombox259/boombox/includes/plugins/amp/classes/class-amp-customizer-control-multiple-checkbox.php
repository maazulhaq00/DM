<?php

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Boombox_AMP_Customize_Control_Multiple_Checkbox' ) ) {

	/**
	 * Multiple checkbox customize control class.
	 *
	 * @access public
	 */
	class Boombox_AMP_Customize_Control_Multiple_Checkbox extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'multiple-checkbox';

		/**
		 * Displays the control content.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function render_content() {

			if ( empty( $this->choices ) ) {
				return;
			} ?>

			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>

			<?php
				$multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
			?>

			<ul>
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<li>
						<label>
							<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ), true ); ?> />
							<?php echo esc_html( $label ); ?>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>

			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>"/>
		<?php
		}

		/**
		 * Sanitize callback
		 */
		public static function validate( $values ) {

			$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;

			return ! empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
		}

	}
}