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


  /**
   * Create a new token in the repo
   * @param  string $hash
   * @param  string $event_type
   * @param  Carbon $expires_at
   * @return Token           The newly created token
   */
  public function create($hash, $event_type = null, $expires_at = null){
    $token = EloquentToken::create([
        'key' => $hash,
        'event_type' => $event_type,
        'expires_at' => $expires_at
      ]);

    return $token;
  }

}
