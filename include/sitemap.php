<?php

require_once 'connection.php';

class sitemap {

    private $class_ul_span3 = 'span3';
    private $class_li_primary = 'primary';
    private $class_li_accent = 'joint accent';
    private $db;

    public function __construct()
    {
        $this->db = new db();
    }

    function build($pid = null)
    {
        $sitemap_html = '';
        if(is_null($pid)){
            $menus = $this->db->dbQuery("SELECT * FROM sitemap WHERE pid IS NULL ORDER BY `order` ASC;");
        } else {
            $menus = $this->db->dbQuery("SELECT * FROM sitemap WHERE pid = $pid ORDER BY `order` ASC;");
        }
        if(!empty($menus)){

            if(!is_null($pid)){
                $sitemap_html .= '<ul class="sortable">';
            }
            foreach($menus as $menu) {
                if(is_null($pid)){
                    $sitemap_html .= '<ul class="sortable ' . $this->class_ul_span3 . '">';
                }
                $id = $menu['id'];
                $class_name = $this->class_li_primary;
                if($menu['type_id'] == 2){
                    $class_name = $this->class_li_accent;
                }
                $sitemap_html .= '<li id="id_' . $id . '" class="' . $class_name . '">' . $menu['name'];
                $sub_menus = $this->db->dbQuery("SELECT * FROM sitemap WHERE pid = $id;");
                if(!empty($sub_menus)){
                    $sitemap_html .= $this->build($id);
                }
                if(is_null($pid)){
                    $sitemap_html .= '</ul>';
                }

                $sitemap_html .= '</li>';
            }
            if(!is_null($pid)) $sitemap_html .= '</ul>';
        }

        return $sitemap_html;
    }

    function save($data)
    {

        header("Cache-Control: no-cache, must-revalidate");
        header("Content-type: application/json");

        $SQL = array();
        foreach($data as $item) {
            $id = (int) $item['id'];
            $pid = ($item['pid'] == 0) ? 'NULL' : (int) $item['pid'];
            $order = (int) $item['order'];
            $SQL[] = "UPDATE `sitemap` SET `pid` = $pid, `order` = $order WHERE `id` = $id";
        }
        $update = $this->db->dbUpdate(implode(";", $SQL));

        if($update == 0){
            die(json_encode(array('respond' => 'Saved')));
        } else {
            die(json_encode(array('respond' => 'Error')));
        }
    }

}

?>
