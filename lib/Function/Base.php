<?php
function include_template($file_name) {
    include_once APP_DIR . 'Template/' . TEMPLATE_NAME . "/{$file_name}";
}

function include_module($file_name) {
    echo "\n<!-- begin module {$file_name} -->\n";
    include_once APP_DIR . 'Template/' . TEMPLATE_NAME . "/inc/{$file_name}";
    echo "\n<!-- end module {$file_name} -->\n";
}

function check_plain($text) {
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function get_ip() {
    $unknown = 'unknown';
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    /*
      处理多层代理的情况
      或者使用正则方式：$ip = preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : $unknown;
    */
    if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip));
    return $ip;
}
?>