<?php

// include api router
require_once UTILS_DIR . '/APIRouter.php';

// log received call
(new EKELog())->save('call', ['account' => Session::get('id','ND')]);

// evaluate api request
(new APIRouter([
  /**
   * Define API routes
   * Structure: [
   *  folder => [filename, filename, ...],
   *  folder => [filename, filename, ...],
   * ]
   */
  'auth' => ['login','register','recovery',],
  'account' => ['update',],

  'project' => ['collections','members',],

  // 'play' => [],
  // 'information' => ['update',],

]))->evaluate();
