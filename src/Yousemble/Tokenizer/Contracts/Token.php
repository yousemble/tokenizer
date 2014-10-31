<?php namespace Yousemble\Tokenizer\Contracts;

interface Token{


  /*  Getters
  -------------------------------------------------- */

  /**
   * Get the id attribute
   * @return int
   */
  public function getId();

  /**
   * Get the hash attribute
   * @return string
   */
  public function getHash();

  /**
   * Get the event-type attribute
   * @return string
   */
  public function getEventType();

  /**
   * Get the expires_at timestamp attribute
   * @return Carbon\Carbon
   */
  public function expiresAt();

  /**
   * Get the verified_at timestamp attribute
   * @return Carbon\Carbon
   */
  public function verifiedAt();

  /**
   * Get the created_at timestamp attribute
   * @return Carbon\Carbon
   */
  public function createdAt();

  /**
   * Check if the token is expired,
   * an expired token may not be verified
   *
   * @return boolean
   */
  public function isExpired();

  /**
   * Check if the token is verified,
   * a verified token may not be expired
   *
   * @return boolean
   */
  public function isVerified();



  /*  Model actions
  -------------------------------------------------- */

  /**
   * Verify the token, setting the verified_at attribute to now()
   * @return Token This token
   * @throws TokenIsExpiredException If the token is expired
   */
  public function verify();

  /**
   * Expire the token, setting the expired_at attribute to now()
   *
   * @return Token This token
   * @throws TokenIsVerifiedException If the token is already verified
   */
  public function expire();


  /**
   * Delete the token
   * @return void
   */
  public function delete();

}





