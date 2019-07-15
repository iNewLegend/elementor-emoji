<?php

namespace ElementorEmoji\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use ElementorEmoji\Controls\EmojiOneArea;

/**
 * Elementor Emoji Widget.
 *
 * Elementor widget that inserts an emoji content into the page.
 *
 * @since 1.0.0
 */
class Emoji extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'emoji_widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Test widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Emoji', '' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Test widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'fas fa-surprise';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Emoji widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register Emoji widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', '' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		// Emoji control
		$this->add_control(
			EmojiOneArea::CONTROL_TYPE,
			[
				'label' => __( 'Emoji', '' ),
				'type'  => EmojiOneArea::CONTROL_TYPE,

			]
		);

		// Alignment
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', '' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', '' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', '' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', '' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', '' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'.control-holder' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// style section
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', '' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', '' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'.control-holder' => 'color: {{VALUE}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'emojiarea_typography',
				'selector' => '.control-holder',
			]
		);

		// Shadow
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '.control-holder',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Emoji widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="control-holder">';
		echo $settings['emojionearea'];
		echo '</div>';
	}

	/**
	 * Render element output in the editor.
	 *
	 * Used to generate the live preview, using a Backbone JavaScript template.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="control-holder">{{{ settings.emojionearea }}}</div>
		<?php
	}
}
