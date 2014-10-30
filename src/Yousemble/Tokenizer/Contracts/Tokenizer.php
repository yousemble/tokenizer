<?php

//all returns a token

/**
 * fire
 *   tokenizer.issued.[event_type]
 *
 */
public function issue($event_type = null, $expires_at = null)


/**
 * fire
 *    tokenizer.verified.[event_type]
 *    tokenizer.reverified.[event_type]
 *    tokeniser.verification-failed.[event_type].[reason]
 */
public function attemptVerification($hash);