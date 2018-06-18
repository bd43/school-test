<?php

/*
 *  Checks to see if url contains slug or multiple slugs
 */
function checkCurrentUrlForSlug($slug = "") {
    if(is_string($slug)) return (strpos(url()->current(), $slug) !== false) ? true : false;
    else if(is_array($slug)) {
        return count(array_filter($slug, function($s){
            return (strpos(url()->current(), $s) !== false) ? true : false;
        })) >= 1 ? true : false;
    } else return false;
}
