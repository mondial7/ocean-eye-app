<?php

/**
 * Serve dashboard to logged users only
 */
if (!USER_LOGGED) {
  // redirect to home
  header('Location: ../');
  exit;
}
include VIEWS_DIR . '/dashboard/index.html';
