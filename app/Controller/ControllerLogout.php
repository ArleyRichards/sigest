<?php

namespace App\Controller;

use App\Model\ClassLogin;
use Src\Traits\TraitUrlParser;

class ControllerLogout extends ClassLogin
{

  use TraitUrlParser;

  public function __construct()
  {
    session_destroy();
    header('Location: login');
    exit();
  }
}
