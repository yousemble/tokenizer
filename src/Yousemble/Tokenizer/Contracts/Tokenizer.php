

//all returns a token

public function issue($event_type = null, $expires_at = null)

public function findById($token_id);

public function findByHash($hash);


/**
 * fire
     tokenizer.verified.[event_type]
     tokenizer.reverified.[event_type]
     tokeniser.verification
 * @param  {[type]} $hash [description]
 * @return {[type]}       [description]
 */
public function attemptVerification($hash);