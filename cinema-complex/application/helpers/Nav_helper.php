<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Before creating new functions, always check if they already exist.
if (!function_exists('build_nav'))
{
    function build_nav($items = NULL)
    {
        // if no items exist, we'll stop the code here.
        if ($items == NULL) return '';

        // start with a blank string.
        $result = '';

        foreach ($items as $item)
        {
            $result .= '<li class="nav-item">';
                $result .= '<a href="' .site_url($item['url']). '" class="nav-link">';
                    $result .= '<i class="icon ' .$item['icon']. '"></i>';
                    $result .= '<span>' .$item['title']. '</span>';
                $result .= '</a>';
            $result .= '</li>';
        }

        // give back the compiled string.
        return $result;
    }
}
