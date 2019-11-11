<?php


    function processData($data){

        //Get product Id using the SKU
        $chmg_wapu_sku = get_option('chmg_wapu_product_sku_el');
        $chmg_wapu_product_name_key = get_option('chmg_wapu_product_name_el');

        $chmg_product_real_sku  = $data[$chmg_wapu_sku];
        $chmg_wapu_product_name = $data[$chmg_wapu_product_name_key];

        $status = '';

        $product_id = wc_get_product_id_by_sku($chmg_product_real_sku);


        //get product object
        $product = getProduct($product_id);

        

       $terms = get_the_terms($product_id, 'product_type');
       

        if(!empty($product)){
        
            $chmg_product_type          = $product->get_type();
            $chmg_show_variation_desc   = get_option('chmg_wapu_product_variation_description_el');
            
                //Set Regular Price
            if('-1' != get_option('chmg_wapu_regular_price_el')){
                setRegularPrice($product,$data);
            }
    

            //Set Regular Price
            if('-1' != get_option('chmg_wapu_sales_price_el')){
                setSalesPrice($product,$data);
            }

            //skip if the user do not approve product variation description to be updated
            if('variation' == $chmg_product_type &&  strlen($chmg_show_variation_desc) <= 0){
                 
            }else{

                if('-1' != get_option('chmg_wapu_short_description_el')){
                    setShortDescription($product,$data);
                }

                if('-1' != get_option('chmg_wapu_main_description_el')){
                    setMainDescription($product,$data);
                }
            }
 
        }else{
            $status = sprintf("%s", $chmg_wapu_product_name." (".$chmg_product_real_sku.")");
        }

        return $status;

    }


    function setRegularPrice($product , $data_array){

        $chmg_wapu_regular_price = get_option('chmg_wapu_regular_price_el');
        $regular_price = $data_array[$chmg_wapu_regular_price];

        /* Set the MAP pricing if the value returned is 1 */
        $chmg_wapu_set_map_price_el =  get_option('chmg_wapu_set_map_price_el');

        /* Get the column value to know if the sales price should be ignored */
        $chmg_wapu_ignore_sale_key = get_option('chmg_wapu_on_sale_el');
        $chmg_wapu_ignore_sale = $data_array[$chmg_wapu_ignore_sale_key];

        /* Get the product sales price */
        $chmg_wapu_sale_price =   get_option('chmg_wapu_sales_price_el');
        $sales_price = $data_array[$chmg_wapu_sale_price];

        /* Get the product MAP pricing */
        $chmg_wapu_map_price =   get_option('chmg_wapu_map_price_el');
        $map_price = $data_array[$chmg_wapu_map_price ];


        if(strlen($sales_price) >= 1 && $chmg_wapu_set_map_price_el == 1 && 'no' == $chmg_wapu_ignore_sale ){
            $product->set_regular_price($map_price);
        }else{
            $product->set_regular_price($regular_price);
        }
        

        $product->save();

    }

    function setSalesPrice($product , $data_array){

        $chmg_wapu_sale_price =   get_option('chmg_wapu_sales_price_el');
        $chmg_wapu_ignore_sale_key = get_option('chmg_wapu_on_sale_el');

        $chmg_wapu_ignore_sale = $data_array[$chmg_wapu_ignore_sale_key];
        
        if('-1' != $chmg_wapu_ignore_sale_key){
             //Check if ignore sale price is on
            if('yes' == $chmg_wapu_ignore_sale){
                $sales_price = '';
            }else{
                $sales_price = $data_array[$chmg_wapu_sale_price];
            }
        }else{
            $sales_price = $data_array[$chmg_wapu_sale_price];
        }
       

        $product->set_sale_price($sales_price);

        $product->save();
    }

    function setShortDescription($product , $data_array){

        $chmg_wapu_short_description =   get_option('chmg_wapu_short_description_el');

       
        $short_description = removeNewLine($data_array[$chmg_wapu_short_description]);

        $product->set_short_description($short_description);

        $product->save();
    }

    function setMainDescription($product , $data_array){

        $chmg_wapu_main_description =   get_option('chmg_wapu_main_description_el');
        $main_description = removeNewLine($data_array[$chmg_wapu_main_description]);

        $product->set_description($main_description);

        $product->save();
    }

    function getProduct($product_id){
        return  wc_get_product( $product_id );
    }

    function removeNewLine($string){
        return str_replace("\\n","",$string);
    }