<?php namespace Yousemble\Tokenizer\Contracts;

use Carbon\Carbon;

interface Tokenizer{

  /**
   * Issue a new token
   *
   * fire
   *   ys.tokenizer.issued.[type]
   *
   * @param string $type The type param for the token
   * @param Carbon $expires_at A custom date for token expiry, null indicates 'never expires'
   * @return Token The issued token
   *
   */
  public function issue($email, $type = null, Carbon $expires_at = null);


  /**
   *
   *  Attempt verification of a token
   *
   * fires
   *    ys.tokenizer.verified.[type]
   *    ys.tokenizer.reverified.[type]
   *    ys.tokenizer.verification-failed.[type]
   *
   * @return Token The verified token or null if verification failed
   *
   */
  public function attemptVerification($hash);


}



