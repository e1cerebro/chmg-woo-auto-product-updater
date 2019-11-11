<?php
    class CHMG_WOO_DB_Utils{

        public static function get_products(){
            $args =  array(
                            'post_type' => 'product',
                            'numberposts' => -1,
                             'post_status' => 'publish',
                            'fields' => 'ids',
                        );
        
            $products  = get_posts($args);
            return $products;
        }

       public function get_product_from_cat(){
        $include_cat = get_option('cplc_include_categories_el');
            $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => '-1',
                'fields' => 'ids',
                'tax_query'             => array(
                    array(
                        'taxonomy'      => 'product_cat',
                        'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
                        'terms'         => $include_cat,
                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ) 
                )
            );
            return  new WP_Query($args);
        }


        public static function get_products_variations($product_id){
            global $woocommerce, $product, $post;
            $product = wc_get_product( $product_id );
            if ($product->is_type( 'variable' ))  {
                $temp_id_arr = array();
                $available_variations = $product->get_available_variations();
                foreach ($available_variations as $key => $value) 
                { 
                    array_push($temp_id_arr, $value['variation_id']);
                }
                return $temp_id_arr;
            }else{
                return false;
            }
           
        }


        public function get_all_product_categories(){
            $taxonomy     = 'product_cat';
            $orderby      = 'name';  
            $show_count   = 0;      // 1 for yes, 0 for no
            $pad_counts   = 0;      // 1 for yes, 0 for no
            $hierarchical = 1;      // 1 for yes, 0 for no  
            $title        = '';  
            $empty        = 0;
        
            $args = array(
                    'taxonomy'     => $taxonomy,
                    'orderby'      => $orderby,
                    'show_count'   => $show_count,
                    'pad_counts'   => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li'     => $title,
                    'hide_empty'   => $empty
            );
            $all_categories = get_categories($args);
            return $all_categories;
        }
    }