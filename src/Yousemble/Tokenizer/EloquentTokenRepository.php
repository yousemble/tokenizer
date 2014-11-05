<?php namespace Yousemble\Tokenizer;

use Yousemble\Tokenizer\Contracts\TokenRepository as TokenRepositoryContract;


class EloquentTokenRepository implements TokenRepositoryContract{


  /**
   * Find a token by key
   * @param  string $key
   * @return Token            The found token or null if not found
   */
  public function findByKey($key){
    return EloquentToken::where('key', '=', $key)->first();
  }


  /**
   * Create a new token in the repo
   * @param  string $hash
   * @param  string $event_type
   * @param  Carbon $expires_at
   * @return Token           The newly created token
   */
  public function create($email, $key, $type = null, $expires_at = null){
    $token = EloquentToken::create([
        'key' => $hash,
        'email' => $email,
        'type' => $type,
        'expires_at' => $expires_at,
        'meta' => $meta
      ]);

    return $token;
  }

}
