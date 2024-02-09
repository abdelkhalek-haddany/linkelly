<?php

use App\Models\Domain;
use Illuminate\Support\Facades\Config;

function _setSession($name, $value)
{
  session()->put($name, $value);
}
function _getSession($name)
{
  return session()->get($name);
}

function get_default_lang()
{
  return   Config::get('app.locale');
}


function UploadImage($image, $folder, $merge = false)
{
  // local code
  if (false) {
    // server code
    $filename = time() . rand(0, 100000) . '.' . pathinfo(basename($image), PATHINFO_EXTENSION);
    $image->move('./../../' . $folder, $filename);
  } else {
    if ($image) {
      $filename = time() . rand(0, 100000) . '.' . pathinfo(basename($image), PATHINFO_EXTENSION);
      $image->move(public_path($folder), $filename);
    } else {
      $filename = "";
    }
  }
  return $filename;
}

function UploadImages($images, $folder, $merge = false)
{
  foreach ($images as $image) {
    $imagesNames[] = UploadImage($image, $folder, $merge);
  }
  $imagesField = implode(',', $imagesNames);
  return $imagesField;
}

function Domains()
{
  $domains = Domain::where('status', '1')->get();
  return $domains;
}
