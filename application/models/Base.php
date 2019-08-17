<?php 
defined('BASEPATH') or exit("Não é possível acessar esse código diretamente!");

/**
 * Classe para códigos estáticos
 * 
 * @author Eduardo Marques <edums@live.com>
 * @copyright 2019 Biblioteca
 */

class Base extends CI_Model
{
    public static $flashdata;

    public function __construct()
    {
        parent::__construct();

        self::$flashdata = $this->session->flashdata();
    }
    
    const PER_PAGE = 25;
    const NUM_LINKS = 5;

    public static function configuracao_paginacao(string $url, int $uri_segment) :array
    {
        $CI =& get_instance();

        return array(
            "base_url" => base_url($url),
            "per_page" => self::PER_PAGE,
            "uri_segment" => $uri_segment,
            "offset" => ($CI->uri->segment($uri_segment)) ? $CI->uri->segment($uri_segment) : 0,
            "num_links" => self::NUM_LINKS,
            "reuse_query_string" => TRUE,

            "full_tag_open" => "<nav><ul class=\"pagination justify-content-end mb-0\">",
            "full_tag_close" => "</ul></nav>",

            "first_tag_open" => "",
            "first_link" => "",
            "first_tag_close" => "",

            "prev_tag_open" => "<li class=\"page-item \">",
            "prev_link" => "<i class=\"fas fa-angle-left\"></i><span class=\"sr-only\">Previous</span>",
            "prev_tag_close" => "</li>",

            "next_tag_open" => "<li class=\"page-item \">",
            "next_link" => "<i class=\"fas fa-angle-right\"></i><span class=\"sr-only\">Previous</span>",
            "next_tag_close" => "</li>",

            "last_tag_open" => "",
            "last_link" => "",
            "last_tag_close" => "",

            "num_tag_open" => "<li class=\"page-item\">",
            "num_tag_close" => "</a></li>",

            "cur_tag_open" => "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">",
            "cur_tag_close" => "</a></li>",

            "attributes" => array(
                "rel" => FALSE,
                "class" => "page-link"
            )
        );
    }
}