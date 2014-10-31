<?php namespace Yousemble\Tokenizer\Events;

use Yousemble\Tokenizer\Contracts\TokenEvent as TokenEventContract;
use Yousemble\Tokenizer\Contracts\Token;


/*  EVENT NAMESPACE: ys.tokenizer.*
-------------------------------------------------- */


class TokenEvent implements TokenEventContract{

  protected $token;

  function __construct(Token $token){
    $this->token = $token;
  }

  public function getToken(){
    return $this->token;
  }

}
