<?php
/**this file is used for sanitizing data that comes out of database
 * @param $string
 * @return string
 */
function escape($string){
    return htmlentities($string,ENT_QUOTES,'UTF-8');
}