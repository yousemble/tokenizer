<?php namespace Yousemble\Tokenizer;

use Yousemble\Tokenizer\Contracts\Tokenizer as TokenizerContract;
use Yousemble\Tokenizer\Contracts\TokenRepository;
use Yousemble\Tokenizer\Events\TokenEvent;
use Yousemble\Tokenizer\Utility\Hasher;

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

  public function issue($email, $type = null, Carbon $expires_at = null)
  {

    $hash_length = (int) $this->config->get('yousemble/tokenizer::token.hash_length', 120);

    $key = Hasher::makeKey($hash_length);

    $token = $this->repo->create($email, $key, $type, $expires_at);

    $this->events->fire('ys.tokenizer.issued.' . $type, [new TokenEvent($token)]);

    return $token;
  }


  /**
   *
   *  Attempt verification of a token
   *
   * fires
   *    ys.tokenizer.verified.[type]
   *
   * @return Token The verified token or null if verification failed
   *
   */
  public function attemptVerification($key){

    $token = $this->repo->findByKey($key);

    if(!$token || $token->isExpired() || $token->isVerified()) return null;

    $token->verify();

    $this->events->fire('ys.tokenizer.verified.' . $token->getEventType(), [new TokenEvent($token)]);

    return $token;
  }

}
