<?php

class Widget_1 extends \Elementor\Widget_Base{
    public function get_name() {
		return 'hello_world_widget_1';
	}

	public function get_title() {
		return esc_html__( 'Hello World 1', 'elementor-test-addon' );
	}

	public function get_icon() {
		return 'eicon-blockquote';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
	}

	protected function register_controls(){
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-test-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'elementor-test-addon' ),
				'placeholder' => esc_html__( 'Enter your title', 'elementor-test-addon' ),
				'default' => 'Hello world'
			]
		);

		$this->add_control(
			'size',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Size', 'elementor-test-addon' ),
				'placeholder' => '0',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 50,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Lightbox', 'elementor-test-addon' ),
				'options' => [
					'default' => esc_html__( 'Default', 'elementor-test-addon' ),
					'yes' => esc_html__( 'Yes', 'elementor-test-addon' ),
					'no' => esc_html__( 'No', 'elementor-test-addon' ),
				],
				'default' => 'no',
			]
		);

		$this->add_control(
			'alignment',
			[
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Alignment', 'elementor-test-addon' ),
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-test-addon' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-test-addon' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-test-addon' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'elementor-test-addon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'elementor-test-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'elementor-test-addon' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'List Item', 'elementor-test-addon' ),
						'default' => esc_html__( 'List Item', 'elementor-test-addon' ),
					],
					[
						'name' => 'link',
						'label' => esc_html__( 'Link', 'elementor-test-addon' ),
						'type' => \Elementor\Controls_Manager::URL,
						'placeholder' => esc_html__( 'https://your-link.com', 'elementor-test-addon' ),
					],
				],
				'default' => [
					[
						'text' => esc_html__( 'List Item #1', 'elementor-test-addon' ),
						'link' => 'https://elementor.com/',
					],
					[
						'text' => esc_html__( 'List Item #2', 'elementor-test-addon' ),
						'link' => 'https://elementor.com/',
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['title'] ) ) {
			return;
		}
		$style = sprintf( 'text-align: %s; font-size: %dpx;', esc_attr( $settings['alignment'] ), esc_attr( $settings['size'] ) );
		?>
		<div style="<?php echo $style; ?>"> <?php echo $settings['title']; ?> </div>
		<div><?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?></div>
		<ul>
		<?php foreach ( $settings['list'] as $index => $item ) : ?>
			<li>
			<?php
			if ( $item['link']['url'] ) {
				?><a href="<?php echo esc_url( $item['link']['url'] ); ?>"><?php echo $item['text']; ?></a><?php
			} else {
				echo $item['text'];
			}
			?>
			</li>
		<?php endforeach; ?>
		</ul>
		<?php
	}

	protected function content_template() {
		?>
		<#
		if ( '' === settings.title ) {
			return;
		}
		var alignment = settings.alignment;
		var size = settings.size;

		var style = 'text-align: ' + alignment + '; font-size: ' + size + 'px;';
		#>
		<div style="{{style}}"> {{{ settings.title }}} </div>
		<div><img src="{{{ settings.image.url }}}"></div>
		<ul>
		<# _.each( settings.list, function( item, index ) { #>
			<li>
			<# if ( item.link && item.link.url ) { #>
				<a href="{{{ item.link.url }}}">{{{ item.text }}}</a>
			<# } else { #>
				{{{ item.text }}}
			<# } #>
			</li>
		<# } ); #>
		</ul>
		<?php
	}
}