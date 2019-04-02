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

    // Homepage Alert
    $wp_customize->add_section( 'ngisweden_homepage_alert_section' , array(
        'title'       => 'Homepage Alert',
        'priority'    => 32,
        'description' => 'Show an alert box at the top of the homepage',
    ) );
    $wp_customize->add_setting( 'ngisweden_homepage_alert_text' );
    $wp_customize->add_control( new NGISweden_Customize_Textarea_Control( $wp_customize, 'ngisweden_homepage_alert_text', array(
        'label'   => 'Alert Text',
        'section' => 'ngisweden_homepage_alert_section',
        'settings'   => 'ngisweden_homepage_alert_text',
    ) ) );
    $wp_customize->add_setting( 'ngisweden_homepage_alert_colour' );
    $wp_customize->add_control( 'ngisweden_homepage_alert_colour', array(
        'label'   => 'Alert Colour:',
        'section' => 'ngisweden_homepage_alert_section',
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
