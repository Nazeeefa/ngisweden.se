<?php
// Theme customiser
function ngisweden_theme_customizer( $wp_customize ) {

    // Helper Functions
    class NGISweden_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
            <?php
        }
    }

    // Banner Messages
    $wp_customize->add_section( 'ngisweden_banner_message_section' , array(
        'title'       => 'Banner Messages',
        'priority'    => 32,
        'description' => 'Show an alert box at the top of every page.',
    ) );
    $wp_customize->add_setting( 'ngisweden_banner_message_text' );
    $wp_customize->add_control( new NGISweden_Customize_Textarea_Control( $wp_customize, 'ngisweden_banner_message_text', array(
        'label'   => 'Banner Text',
        'section' => 'ngisweden_banner_message_section',
        'settings'   => 'ngisweden_banner_message_text',
    ) ) );
    $wp_customize->add_setting( 'ngisweden_banner_message_colour' );
    $wp_customize->add_control( 'ngisweden_banner_message_colour', array(
        'label'   => 'Banner Colour:',
        'section' => 'ngisweden_banner_message_section',
        'type'    => 'select',
        'choices'    => array(
            'alert-info' => 'Blue',
            'alert-success' => 'Green',
            'alert-warning' => 'Yellow',
            'alert-danger' => 'Red',
        ),
    ) );

}
add_action('customize_register', 'ngisweden_theme_customizer');
