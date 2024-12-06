<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_Listing_Item_Logo extends GVAElement_Base{
	 
	const NAME = 'gva_lt_item_logo';
	const TEMPLATE = 'listing/item-logo';
	const CATEGORY = 'fioxen_listing';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('Listing Item Logo', 'fioxen-themer');
	}

	public function get_keywords() {
		return [ 'listing', 'item', 'logo' ];
	}

	protected function register_controls() {
		//--
		$this->start_controls_section(
			self::NAME . '_content',
			[
				'label' => __('Content', 'fioxen-themer'),
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Default Logo Image', 'fioxen-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/lt-logo.jpg',
				],
			]
		);
		$this->add_responsive_control(
			'max_width',
			[
				'label' => __( 'Max Width', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 100
				],
				'range' => [
				  'px' => [
					 'min' => 20,
					 'max' => 300,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gva-listing-logo .content-inner' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

	}

	protected function render(){
		parent::render();

		$settings = $this->get_settings_for_display();
		include $this->get_template(self::TEMPLATE . '.php');
	}
}

$widgets_manager->register(new GVAElement_Listing_Item_Logo());
