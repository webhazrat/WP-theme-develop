<?php
namespace Elementor;

class MYEW_Example_Widget extends Widget_Base{
    public function get_name(){
        return 'myew-example-widget-id';
    }

    public function get_title(){
        return esc_html(__('Example Widget', 'myew'));
    }

    public function get_script_depends(){
        return array('myew-script');
    }

    public function get_icon(){
        return '';
    }

    public function get_categories(){
        return array('myew-for-elementor');
    }

    public function _register_controls(){
        // Content settings
        $this->start_controls_section(
            'content_section',
            array(
                'label' => __('Content Settings', 'myew'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT
            )
        );
        $this->end_controls_section();

        // Style tab
        $this->style_tab();
    }

    private function style_tab(){

    }

    protected function render(){
        $myew_values = $this->get_settings_for_display();
        ?>
            <div>
                <h1>This is an example widget</h1>
            </div>
        <?php
    }

    protected function content_template(){

    }
}

Plugin::instance()->widgets_manager->register_widget_type(new MYEW_Example_Widget());