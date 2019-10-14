<?php


    function processData($data){

        //Get product Id using the SKU
        $chmg_wapu_sku = get_option('chmg_wapu_product_sku_el');
        $product_id = wc_get_product_id_by_sku($data[$chmg_wapu_sku]);

        //get product object
        $product = getProduct($product_id);

        //Set Regular Price
        setRegularPrice($product,$data);

        //Set Regular Price
        setSalesPrice($product,$data);
       
        //Set Regular Price
        setShortDescription($product,$data);
       
        //Set Regular Price
        setMainDescription($product,$data);

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
        
        //Check if ignore sale price is on
        if('yes' == $chmg_wapu_ignore_sale){
            $sales_price = '';
        }else{
            $sales_price = $data_array[$chmg_wapu_sale_price];
        }

        $product->set_sale_price($sales_price);

        $product->save();
    }

    function setShortDescription($product , $data_array){

        $chmg_wapu_short_description =   get_option('chmg_wapu_short_description_el');

        $short_description = $data_array[$chmg_wapu_short_description];

        $product->set_short_description($short_description);

        $product->save();
    }

    function setMainDescription($product , $data_array){

        $chmg_wapu_main_description =   get_option('chmg_wapu_main_description_el');
        $main_description = $data_array[$chmg_wapu_main_description];

        $product->set_description($main_description);

        $product->save();
    }

    function getProduct($product_id){
        return $product = wc_get_product( $product_id );
    }