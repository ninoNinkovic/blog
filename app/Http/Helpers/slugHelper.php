<?php

/**
 * Generates a URL friendly "slug" from the given unicode string.
 *
 * @param  string $str
 *
 * @param  string $delimiter
 *
 * @return string
 */
function utf8_slug($str, $delimiter = '-')
{
    $string = strtolower(trim($str, '-'));
    $special_chars  = array('&#39;');
    $replace = array('');
    $filter_special_chars = str_replace($special_chars, $replace, $string);
    $search  = array('&', '#', ':', ',', '.', '?');
    $replace = array('and', ' ', ' ', ' ', ' ', '');
    $filter_chars = str_replace($search, $replace, $filter_special_chars);
    $slug = preg_replace("/[\/_|+ -]+/", $delimiter, trim($filter_chars));

    return $slug;
}