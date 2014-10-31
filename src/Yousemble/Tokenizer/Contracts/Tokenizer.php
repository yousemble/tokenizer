<?php namespace Yousemble\Tokenizer\Contracts;

use Carbon\Carbon;

interface Tokenizer{

  /**
   * Issue a new token
   *
   * fire
   *   tokenizer.issued.[event_type]
   *
   * @param string $event_type The event_type param for the token, defaults to 'default'
   * @param Carbon $expires_at A custom date for token expiry, null indicates 'never expires'
   * @return Token The issued token
   *
   */
  public function issue($event_type = 'default', Carbon $expires_at = null);


  /**
   *
   *  Attempt verification of a token
   *
   * fires
   *    tokenizer.verified.[event_type]
   *    tokenizer.reverified.[event_type]
   *    tokeniser.verification-failed.[event_type]
   *
   * @return Token The verified token or null if verification failed
   *
   */
  public function attemptVerification($hash);


}



