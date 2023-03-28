<?php

if (class_exists('WP_Customize_Control')){
	class Multi_Input_Custom_control extends WP_Customize_Control{
		public $type = 'multi_input';
		public function enqueue(){
			wp_enqueue_script( 'custom_controls', get_template_directory_uri().'/inc/customizer/js/custom_controls.js', array( 'jquery' ),'', true );
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/inc/customizer/css/custom_controls.css');
		}
		public function render_content(){
			?>
			<label class="customize_multi_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post($this->description); ?></p>
				<input type="hidden" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($this->value()); ?>" class="customize_multi_value_field" data-customize-setting-link="<?php echo esc_attr($this->id); ?>"/>
				<div class="customize_multi_fields">
					<div class="d-grid-auto-10 mb-15">
						<input type="text" value="" class="customize_multi_single_field"/>
						<a href="#" class="button customize_multi_remove_field">X</a>
					</div>
				</div>
				<a href="#" class="button button-primary customize_multi_add_field"><?php esc_attr_e('Add More', 'mytheme') ?></a>
			</label>
			<?php
		}
	}
}
