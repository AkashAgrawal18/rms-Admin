<?php date_default_timezone_set('Asia/Kolkata');
class Report_model extends CI_model
{

    //==========================Stock List===========================//

    public function get_active_products($item = '', $cat = '')
    {
        $this->db->select('*');

        $this->db->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left');

        if (!empty($item)) {
            $this->db->where('m_product_id', $item);
        }
        if (!empty($cat)) {
            $this->db->where('m_product_cat_id', $cat);
        }

        $this->db->where('m_product_status', 1);

        return $this->db->get('master_product')->result();
    }

    public function get_purchase_item($from = '', $to = '',  $type = '', $item = '', $cat = '',$search='', $size = '', $color = '')
    {
        $this->db->select('sum(m_purchase_qty) as itemqty,m_purchase_spo,m_purchase_product,m_purchase_price,m_purchase_date,sum(m_purchase_total)  as subtotal,m_purchase_invoiceno,m_purchase_type,colour.m_group_name as m_color_name,size.m_group_name as m_size_name,fabric.m_group_name as m_fabric_name,m_product_id,m_product_name,m_product_purche_price,m_product_mrp,m_product_seles_price,m_product_cat_id,m_category_name,m_product_slug,m_product_unit,m_product_size,m_product_color,m_product_fabric,m_product_des,m_product_barscode,m_purchase_color,m_purchase_size,unit.m_group_name as m_unit_title,taxgst.m_group_name as m_tax_value')
            ->join('master_product', 'master_product.m_product_id = master_purchase_tbl.m_purchase_product', 'left')
            ->join('master_goups_tbl taxgst', 'taxgst.m_group_id = master_product.m_product_taxgst', 'left')
            ->join('master_categories', 'master_categories.m_category_id = master_product.m_product_cat_id', 'left')
            ->join('master_goups_tbl unit', 'unit.m_group_id = master_product.m_product_unit', 'left')
            ->join('master_goups_tbl fabric', 'fabric.m_group_id = master_product.m_product_fabric', 'left')
            ->join('master_goups_tbl size', 'size.m_group_id = master_purchase_tbl.m_purchase_size', 'left')
            ->join('master_goups_tbl colour', 'colour.m_group_id = master_purchase_tbl.m_purchase_color', 'left');
        
        if (!empty($type)) {
            $this->db->where('m_purchase_type', $type);
        }
        if (!empty($item)) {
            $this->db->where('m_purchase_product', $item);
        }
       
        if (!empty($size)) {
            $this->db->where('m_purchase_size', $size);
        }
        if (!empty($color)) {
            $this->db->where('m_purchase_color', $color);
        }
        if (!empty($cat)) {
            $this->db->where('m_product_cat_id', $cat);
        }

        if (!empty($from)) {
            $this->db->where('m_purchase_date >=', $from);
        }

        if (!empty($to)) {
            $this->db->where('m_purchase_date <=', $to);
        }

        if (!empty($search)) {
         
            $this->db->where("(m_product_name LIKE '%$search%' OR m_product_slug LIKE '%$search%' OR m_product_barscode LIKE '%$search%')");
        }

        $this->db->group_by('m_purchase_product');
        $this->db->group_by('m_purchase_size');
        $this->db->group_by('m_purchase_color');

        return $this->db->get('master_purchase_tbl')->result();
    }


    public function get_sale_item($from = '', $to = '', $item = '', $size = '', $color = '')
    {
        $this->db->select('sum(m_sale_qty) as itemqty,sum(m_sale_total) as subtotal,m_sale_spo,m_sale_invoiceno,m_sale_product,m_sale_price,m_sale_date');

        if (!empty($item)) {
            $this->db->where('m_sale_product', $item);
        }
        if (!empty($size)) {
            $this->db->where('m_sale_size', $size);
        }
        if (!empty($color)) {
            $this->db->where('m_sale_color', $color);
        }
        if (!empty($from)) {
            $this->db->where('m_sale_date >=', $from);
        }
        if (!empty($to)) {
            $this->db->where('m_sale_date <=', $to);
        }
        $this->db->group_by('m_sale_product');
        $this->db->group_by('m_sale_size');
        $this->db->group_by('m_sale_color');
        return $this->db->get('master_sales_tbl')->result();
    }

    public function get_stock_list($from = '', $to = '', $item = '',$cat = '',$search='',$group = '')
    {

        $result = array();

        $all_item = $this->get_purchase_item($from, $to,1, $item, $cat,$search);

        if (!empty($all_item)) {

            foreach ($all_item as $key) {
                // $item_purchase_open = $this->get_purchase_item($from, date('Y-m-d', strtotime($to . '-1day')), $key->m_product_id,1);
                $pur_rtn_open = $this->get_purchase_item($from, date('Y-m-d', strtotime($to . '-1day')), 2, $key->m_purchase_product, null,null, $key->m_purchase_size, $key->m_purchase_color);
                $item_sale_open = $this->get_sale_item($from, date('Y-m-d', strtotime($to . '-1day')), $key->m_purchase_product, $key->m_purchase_size, $key->m_purchase_color);

                // $item_purchase_count = $this->get_purchase_item($from, $to, $key->m_product_id,1);
                $pur_rtn_count = $this->get_purchase_item($from, $to, 2, $key->m_purchase_product, null,null, $key->m_purchase_size, $key->m_purchase_color);
                $item_sale_count = $this->get_sale_item($from, $to, $key->m_purchase_product, $key->m_purchase_size, $key->m_purchase_color);

                $open_pur_qty = $key->itemqty;

                if (isset($pur_rtn_open[0])) {
                    $open_retun_qty = $pur_rtn_open[0]->itemqty;
                } else {
                    $open_retun_qty = 0;
                }

                if (isset($item_sale_open[0])) {

                    $open_sale_qty = $item_sale_open[0]->itemqty;
                } else {
                    $open_sale_qty = 0;
                }

                $open_balance_qty =  ($open_pur_qty - $open_retun_qty - $open_sale_qty);


                if (isset($pur_rtn_count[0])) {

                    $retun_qty = $pur_rtn_count[0]->itemqty;
                } else {

                    $retun_qty = 0;
                }

                if (isset($item_sale_count[0])) {

                    $sale_qty = $item_sale_count[0]->itemqty;
                } else {

                    $sale_qty = 0;
                }

                $balance_qty =  ($open_pur_qty - $retun_qty - $sale_qty);

                $product_images = $this->db->select('m_image_id,m_image_product_img')->where('m_image_product_id', $key->m_product_id)->get('master_image_tbl')->result();

                $res = (object)array(
                    "m_product_id" => $key->m_product_id,
                    "m_product_name" => $key->m_product_name,
                    "m_product_purche_price" => $key->m_product_purche_price,
                    "m_product_seles_price" => $key->m_product_seles_price,
                    "m_product_mrp" => $key->m_product_mrp,
                    "m_product_cat_id" => $key->m_product_cat_id,
                    "m_category_name" => $key->m_category_name,
                    "m_tax_value" => $key->m_tax_value,
                    "m_product_slug" => $key->m_product_slug,
                    "m_product_unit" => $key->m_product_unit,
                    "m_unit_title" => $key->m_unit_title,
                    "m_color_id" => $key->m_purchase_color,
                    "m_color_name" => $key->m_color_name,
                    "m_size_id" => $key->m_purchase_size,
                    "m_size_name" => $key->m_size_name,
                    "m_product_fabric" => $key->m_product_fabric,
                    "m_fabric_name" => $key->m_fabric_name,
                    "m_product_des" => $key->m_product_des,
                    "m_product_barscode" => $key->m_product_barscode,
                    "m_product_image" => isset($product_images[0]->m_image_product_img) ? $product_images[0]->m_image_product_img : '',
                    "purchase_qty" => $open_pur_qty,
                    "return_qty" => $retun_qty,
                    "sale_qty" => $sale_qty,
                    "balance_qty" => $balance_qty,
                    "opening_qty" => $open_balance_qty,
                    "closing_qty" =>  $balance_qty,

                );
                if ($balance_qty > 0) {
                    $result[] = $res;
                }
            }
        }
    //   echo '<pre>'; print_r(); die ;
        if($group == 1){
            return  $this->unique_multidimensional_array($result,'m_product_id'); 
        }else {
            return  $result;
        }

      
    }

    function unique_multidimensional_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();
    
        foreach($array as $val) {
            if (!in_array($val->$key, $key_array)) {
                $key_array[$i] = $val->$key;
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
    //==========================Stock List===========================//

}
