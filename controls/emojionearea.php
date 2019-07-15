<?php

namespace ElementorEmoji\Controls;

use Elementor\Base_Data_Control;

/**
 * Elementor emoji one area control.
 *
 * A control for displaying a textarea with the ability to add emojis.
 *
 * @since 1.0.0
 */
class EmojiOneArea extends Base_Data_Control {

	const CONTROL_TYPE = 'emojionearea';

	/**
	 * Get emoji one area control type.
	 *
	 * Retrieve the control type, in this case `emojionearea`.
	 *
	 * @return string Control type.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_type() {
		return self::CONTROL_TYPE;
	}

	/**
	 * Enqueue emoji one area control scripts and styles.
	 *
	 * Used to register and enqueue custom scripts and styles used by the emoji one
	 * area control.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue() {
		// Styles
		wp_register_style( 'emojionearea', 'https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.css', [], '3.4.1' );
		wp_enqueue_style( 'emojionearea' );

		// Scripts
		wp_register_script( 'emojionearea', 'https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.js', [], '3.4.1', true );
		wp_register_script( 'emojionearea-control', plugin_dir_url( __FILE__ ) . '../assets/js/emojionearea-control.js', [
			'emojionearea',
			'elementor-editor',
		], '1.0.0', true );
		wp_enqueue_script( 'emojionearea-control' );
	}

	/**
	 * Get emoji one area control default settings.
	 *
	 * Retrieve the default settings of the emoji one area control. Used to return
	 * the default settings while initializing the emoji one area control.
	 *
	 * @return array Control default settings.
	 * @since 1.0.0
	 * @access protected
	 *
	 */
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'rows' => 3,
			'emojionearea_options' => [],
		];
	}

	/**
	 * Render emoji one area control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label
				}}}</label>
			<div class="elementor-control-input-wrapper">
				<textarea id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-tag-area"
						  rows="{{ data.rows }}" data-setting="{{ data.name }}"
						  placeholder="{{ data.placeholder }}"></textarea>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}
