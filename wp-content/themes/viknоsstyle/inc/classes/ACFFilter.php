<?php
/**
 * Class ACFFilter
 */
// Exemple:
//if(class_exists('ACFFilter')){
//    new ACFFilter('field_5bf537ae6aa0e','tpl-payment.php','relationship');
//    new ACFFilter('field_5bf7cb02c25a2','tpl-casino.php','post_object');
//}

class ACFFilter
{
    private $key;
    private $template_name;
    private $field_type;

    function __construct($key, $template_name, $field_type)
    {
        $this->key = $key;
        $this->template_name = $template_name;
        $this->field_type = $field_type;
        $this->filter();
    }

    public function filter_query( $args )
    {
        // show only pages with this special template
        $args['meta_key'] = '_wp_page_template';
        $args['meta_value'] = $this->template_name;
        return $args;
    }

    private function filter()
    {
        add_filter('acf/fields/'.$this->field_type.'/query/key='.$this->key.'', array( $this, 'filter_query' ), 10, 3);
    }
}