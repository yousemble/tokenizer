<?php namespace Yousemble\Tokenizer;

use Yousemble\Tokenizer\Contracts\TokenRepository as TokenRepositoryContract;


class EloquentTokenRepository implements TokenRepositoryContract{

  /**
   * Find a token by ID
   * @param  int $token_id
   * @return Token           The found token or null if not found
   */
  public function findById($token_id){
    return EloquentToken::find($token_id);
  }

  /**
   * Find a token by hash
   * @param  string $hash
   * @return Token            The found token or null if not found
   */
  public function findByHash($hash){
    return EloquentToken::where('key', '=', $hash)->first();
  }

}
