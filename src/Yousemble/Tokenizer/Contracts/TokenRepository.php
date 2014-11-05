<?php namespace Yousemble\Tokenizer\Contracts;

interface TokenRepository{

  /**
   * Find a token by key
   * @param  string $key
   * @return Token            The found token or null if not found
   */
  public function findByKey($key);


  /**
   * Create a new token in the repo
   * @param  string $email
   * @param  string $key
   * @param  string $event_type
   * @param  Carbon $expires_at
   * @return Token           The newly created token
   */
  public function create($email, $key, $type = null, $expires_at = null);

}





