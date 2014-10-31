<?php namespace Yousemble\Tokenizer\Contracts;

interface TokenRepository{

  /**
   * Find a token by ID
   * @param  int $token_id
   * @return Token           The found token or null if not found
   */
  public function findById($token_id);

  /**
   * Find a token by hash
   * @param  string $hash
   * @return Token            The found token or null if not found
   */
  public function findByHash($hash);


}





