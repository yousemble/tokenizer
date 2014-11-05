<?php namespace Yousemble\Tokenizer;

use Yousemble\Tokenizer\Contracts\Token as TokenContract;
use Yousemble\Tokenizer\Exceptions\TokenIsExpiredException;
use Yousemble\Tokenizer\Exceptions\TokenIsVerifiedException;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class EloquentToken extends Model implements TokenContract{

  protected $table = 'tokens';

  protected $fillable = [
    'email',
    'key',
    'type',
    'expires_at'
  ];

  public function getDates()
  {
      return array('created_at', 'expires_at', 'verified_at');
  }


  /*  TokenContract
  -------------------------------------------------- */

  /**
   * Get the email attribute
   * @return string
   */
  public function getEmail(){
    return (string) $this->email;
  }

  /**
   * Get the hash attribute
   * @return string
   */
  public function getKey(){
    return (string) $this->key;
  }

  /**
   * Get the event-type attribute
   * @return string
   */
  public function getType(){
    return (string) $this->event_type;
  }


  /**
   * Get the expires_at timestamp attribute
   * @return Carbon\Carbon
   */
  public function expiresAt(){
    return $this->expires_at;
  }

  /**
   * Get the verified_at timestamp attribute
   * @return Carbon\Carbon
   */
  public function verifiedAt(){
    return $this->verified_at;
  }

  /**
   * Get the created_at timestamp attribute
   * @return Carbon\Carbon
   */
  public function createdAt(){
    return $this->created_at;
  }

  /**
   * Check if the token is expired,
   * an expired token may not be verified
   *
   * @return boolean
   */
  public function isExpired(){
    return (!is_null($this->expires_at) && Carbon::now()->gte($this->expires_at));
  }

  /**
   * Check if the token is verified,
   * a verified token may not be expired
   *
   * @return boolean
   */
  public function isVerified(){
    return (!is_null($this->verified_at) && Carbon::now()->gte($this->verified_at));
  }



  /**
   * Verify the token, setting the verified_at attribute to now()
   * @return Token This token
   * @throws TokenIsExpiredException If the token is expired
   */
  public function verify(){
    if($this->isExpired()) throw new TokenIsExpiredException('Attempting to verify an expired token');

    $this->verified_at = Carbon::now();
    $this->save();

    return $this;
  }

  /**
   * Expire the token, setting the expired_at attribute to now()
   *
   * @return Token This token
   * @throws TokenIsVerifiedException If the token is already verified
   */
  public function expire(){
    if($this->isVerified()) throw new TokenIsVerifiedException('Attempting to expire a verified token');

    $this->verified_at = Carbon::now();
    $this->save();

    return $this;
  }

  /**
   * Delete the token
   * @return void
   */
  public function delete(){
    $this->delete();
  }

}
