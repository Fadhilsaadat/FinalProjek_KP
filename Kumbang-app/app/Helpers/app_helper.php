<?php
if (!function_exists('post')) {
  function post($var = null)
  {
    $request = \Config\Services::request();
    return $request->getPost($var);
  }
}

if (!function_exists('uuid')) {
  function uuid()
  {
    $namesp = '11111111-1111-1111-1111-111111111111';
    $name = mt_rand(0, 0xffff) . microtime();
    if (!is_uuidvalid($namesp)) return false;

    $nhex = str_replace(array('-', '{', '}'), '', $namesp);
    $nstr = '';

    for ($i = 0; $i < strlen($nhex); $i += 2) {
      $nstr .= chr(hexdec($nhex[$i] . $nhex[$i + 1]));
    }

    $hash = sha1($nstr . $name);
    return sprintf(
      '%08s-%04s-%04x-%04x-%12s',
      substr($hash, 0, 8),
      substr($hash, 8, 4),
      (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,
      (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
      substr($hash, 20, 12)
    );
  }
}

if (!function_exists('is_uuidvalid')) {
  function is_uuidvalid($uuid)
  {
    return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?' .
      '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
  }
}
