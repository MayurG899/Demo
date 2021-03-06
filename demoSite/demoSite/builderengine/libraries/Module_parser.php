<?php
/***********************************************************
* BuilderEngine Community Edition v1.0.0
* ---------------------------------
* BuilderEngine CMS Platform - BuilderEngine Limited
* Copyright BuilderEngine Limited 2012-2017. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2017-01-17 | File version: 1.0.0
*
***********************************************************/
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Module_parser {
 
    // parse constants ( site name, slogan, motto or whatever constant strings )
 
        var $l_delim = '{';
        var $r_delim = '}';
 
        public function parse($template)
        {
                $CI =& get_instance();
        $CI->output->append_output($this->_parse($template));
        }
 
        function _parse($template)
        {
 
                $template = $this->_parse_theme_components($template);
                $template = $this->_parse_methods($template);
 
                return $template;
        }
 
        function _parse_methods($string, $depth = 0) {
                if($depth > 50) //super simple recursive fix
                        return $string;
                if (FALSE === ($matches = $this->_match_methods($string, 'module')))
                {
                        return $string;
                }
                foreach($matches[0] as $match) {

                        $result = str_replace($this->l_delim . "module:", '', $match);
                        $result = str_replace($this->r_delim, '', $result);

                        $values = explode('|', $result);
                        $handler = $values[0]."/_remap";

                        $arguments = array();

                        if(array_key_exists(1, $values)) {
                            $arguments = explode(',', $values[1]);
                        }

                        if(count($arguments) == 0)
                            array_push($arguments, "index");

                        $module_content = Modules::run_with_params($handler, $arguments);

                        $string = str_replace($match, $module_content, $string);

                }

                return $this->_parse_methods($string, ++$depth);
        }
 
    function _parse_theme_components($string) {
        global $active_show;
 
        if (FALSE === ($matches = $this->_match_methods($string, "theme")))
        {
            return $string;
        }
 
        foreach($matches[0] as $match) {
            $result = str_replace($this->l_delim . "theme:", '', $match);
            $result = str_replace($this->r_delim, '', $result);
 
            $view_path = "../.." . get_theme_path() . $result . ".php";
 
            $theme_view =
                $active_show->controller->load->view($view_path, null, true);
 
            $string = str_replace($match, $theme_view, $string);
        }
 
        return $string;
    }
 
        function _match_methods($string, $type = "")
        {
                if ( ! preg_match_all("|" . preg_quote($this->l_delim . $type . ':') . ".*" . preg_quote($this->r_delim) . "|", $string, $matches))
                {
                        return FALSE;
                }
 
                return $matches;
        }
 
}