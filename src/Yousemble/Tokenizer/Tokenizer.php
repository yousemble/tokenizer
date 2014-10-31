<?php namespace Yousemble\Tokenizer;

use Yousemble\Tokenizer\Contracts\Tokenizer as TokenizerContract;
use Yousemble\Tokenizer\Contracts\TokenRepository;
use Yousemble\Tokenizer\Events\TokenIssuedEvent;
use Yousemble\Tokenizer\Events\TokenVerifiedEvent;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Support\Str;

use Illuminate\Contracts\Events\Dispatcher;

use Carbon\Carbon;

class Tokenizer implements TokenizerContract {

  protected $repo;
  protected $config;
  protected $events;

  function __construct(TokenRepository $repo, ConfigRepository $config, Dispatcher $events){
    $this->repo = $repo;
    $this->config = $config;
    $this->events = $events;
  }


  /*  TokenizerContract
  -------------------------------------------------- */

  /**
   * Issue a new token
   *
   * fire
   *   tokenizer.issued.[event_type]
   *
   * @param string $event_type The event_type param for the token (optional)
   * @param Carbon $expires_at A custom date for token expiry, null indicates 'never expires'
   * @return Token The issued token
   *
   */
  public function issue($event_type = null, Carbon $expires_at = null){

    //get hash length from config or use 120 default
    $hash_length = 120;
    if($this->config->has('yousemble/tokenizer::token.hash_length')){
      $hash_length = (int) $this->config->get('yousemble/tokenizer::token.hash_length');
    }

    $hash = Str::random($hash_length);

    $token = $this->repo->create($hash, $event_type, $expires_at);

    $this->events->fire('ys.tokenizer.issued.' . $event_type, [new TokenIssuedEvent($token)]);

    return $token;

  }


  /**
   *
   *  Attempt verification of a token
   *
   * fires
   *    ys.tokenizer.verified.[event_type]
   *
   * @return Token The verified token or null if verification failed
   *
   */
  public function attemptVerification($hash){

    $token = $this->repo->findByHash($hash);

    if(!$token || $token->isExpired() || $token->isVerified()) return null;

    $token->verify();

    $this->events->fire('ys.tokenizer.verified.' . $token->getEventType(), [new TokenVerifiedEvent($token)]);

    return $token;
  }

}
