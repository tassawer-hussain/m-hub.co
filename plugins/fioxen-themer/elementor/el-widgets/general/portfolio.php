<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Portfolio extends GVAElement_Base{
    const NAME = 'gva-portfolio';
    const TEMPLATE = 'general/portfolio/';
    const CATEGORY = 'fioxen_general';

    public function get_name() {
        return self::NAME;
    }

    public function get_categories() {
        return array(self::CATEGORY);
    }

    public function get_title() {
        return esc_html__('Portfolio', 'fioxen-themer');
    }

    public function get_keywords() {
        return [ 'portfolio', 'content', 'carousel', 'grid' ];
    }

    public function get_script_depends() {
      return [
          'swiper',
          'isotope',
          'gavias.elements'
      ];
    }

    public function get_style_depends() {
        return [
            'swiper'
        ];
    }

    private function get_categories_list(){
        $categories = array();

        $categories['none'] = esc_html__('None', 'fioxen-themer');
        $taxonomy = 'category_portfolio';
        $tax_terms = get_terms( $taxonomy );
        if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ){
            foreach( $tax_terms as $item ) {
                $categories[$item->term_id] = $item->name;
            }
        }
        return $categories;
    }

    private function get_posts() {
        $posts = array();

        $loop = new \WP_Query( array(
            'post_type' => array('portfolio'),
            'posts_per_page' => -1,
            'post_status'=>array('publish'),
        ) );

        $posts['none'] = esc_html__('None', 'fioxen-themer');

        while ( $loop->have_posts() ) : $loop->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $posts[$id] = $title;
        endwhile;

        wp_reset_postdata();

        return $posts;
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__('Query & Layout', 'fioxen-themer'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'category_ids',
            [
                'label' => esc_html__('Select By Category', 'fioxen-themer'),
                'type' => Controls_Manager::SELECT2,
                'multiple'    => true,
                'default' => '',
                'options'   => $this->get_categories_list()
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label' => esc_html__('Select Individually', 'fioxen-themer'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple'    => true,
                'label_block' => true,
                'options'   => $this->get_posts()
            ]  
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'fioxen-themer'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__('Order By', 'fioxen-themer'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date'  => esc_html__('Date', 'fioxen-themer'),
                    'post_title' => esc_html__('Title', 'fioxen-themer'),
                    'menu_order' => esc_html__('Menu Order', 'fioxen-themer'),
                    'rand'       => esc_html__('Random', 'fioxen-themer'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'fioxen-themer'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__('ASC', 'fioxen-themer'),
                    'desc' => esc_html__('DESC', 'fioxen-themer'),
                ],
            ]
        );

        $this->add_control( // xx Layout
            'layout_heading',
            [
                'label'   => esc_html__('Layout', 'fioxen-themer'),
                'type'    => Controls_Manager::HEADING,
            ]
        );
         $this->add_control(
            'layout',
            [
                'label'   => esc_html__('Layout Display', 'fioxen-themer'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'      => esc_html__('Grid', 'fioxen-themer'),
                    'carousel'  => esc_html__('Carousel', 'fioxen-themer'),
                ]
            ]
        );
        $this->add_control(
            'style',
            [
                'label'     => esc_html__('Style', 'fioxen-themer'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default' => 'portfolio-style-1',
                'options' => [
                    'portfolio-style-1'         => esc_html__('Item Portfolio Style I', 'fioxen-themer'),
                    'portfolio-style-2'         => esc_html__('Item Portfolio Style II', 'fioxen-themer')
                ],
                'condition' => [
                    'layout' => array('grid', 'carousel')
                ]
            ]
        );
        $this->add_control(
            'content_max_width',
            [
               'label'     => esc_html__('Content Width', 'fioxen-themer'),
               'type'      => \Elementor\Controls_Manager::NUMBER,
               'default'   => 270,
               'selectors' => [
                    '{{WRAPPER}} .portfolio-v1 .case-content .content-inner, .portfolio-v1 .case-content-hover .content-inner' => 'max-width: {{VALUE}}px;',
                ],
               'condition' => [
                    'style' => 'portfolio-style-1'
                ],
            ]
        );

        $this->add_control(
            'image_size',
            [
               'label'     => esc_html__('Style', 'fioxen-themer'),
               'type'      => \Elementor\Controls_Manager::SELECT,
               'options'   => $this->get_thumbnail_size(),
               'default'   => 'fioxen_medium'
            ]
        );
        $this->add_control(
            'isotope_filter',
            [
                'label'     => esc_html__('Isotope Filter', 'fioxen-themer'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'layout' => 'grid'
                ],
            ]
        );
        $this->add_control(
            'pagination',
            [
                'label'     => esc_html__('Pagination', 'fioxen-themer'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'layout' => 'grid'
                ],
            ]
        );

        $this->end_controls_section();

        $this->add_control_carousel(false, array('layout' => 'carousel'));

        $this->add_control_grid(array('layout' => 'grid'));

    }

    public static function get_query_args(  $settings ) {
        $defaults = [
            'post_ids' => '',
            'category_ids' => '',
            'orderby' => 'date',
            'order' => 'desc',
            'posts_per_page' => 3,
            'offset' => 0,
        ];

        $settings = wp_parse_args( $settings, $defaults );
        $cats = $settings['category_ids'];
        $ids = $settings['post_ids'];

        $query_args = [
            'post_type' => 'portfolio',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status' => 'publish', // Hide drafts/private posts for admins
        ];

        if($cats){
            if( is_array($cats) && count($cats) > 0 ){
                $field_name = is_numeric($cats[0]) ? 'term_id':'slug';
                $query_args['tax_query'] = array(
                    array(
                      'taxonomy' => 'category_portfolio',
                      'terms' => $cats,
                      'field' => $field_name,
                      'include_children' => false
                    )
                );
            }
        }

      if( is_array($ids) && count($ids) > 0 ){
        $query_args['post__in'] = $ids;
        $query_args['orderby'] = 'post__in';
      }

        if(is_front_page()){
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        }else{
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
 
        return $query_args;
    }


    public function query_posts() {
        $query_args = $this->get_query_args( $this->get_settings() );

        return new WP_Query( $query_args );
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        printf('<div class="gva-element-%s gva-element">', $this->get_name() );
        if( !empty($settings['layout']) ){
            include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
        }
        print '</div>'; 

    }


}
      $widgets_manager->register(new GVAElement_Portfolio());
