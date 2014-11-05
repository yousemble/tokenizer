<?php namespace Yousemble\Auth\Utility;

use Illuminate\Support\Str;

class Hasher{
  public static function makeKey($hash_length){

    $hash_length = 120;

    if($this->config->has('yousemble/tokenizer::token.hash_length')){
      $hash_length = (int) $this->config->get('yousemble/tokenizer::token.hash_length');
    }

    $hash = Str::random($hash_length);
  }
}
