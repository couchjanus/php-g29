<?php

namespace Core\Rules;


class Password extends AbstractRule implements Checkable
{

  protected $msg;

  public  function __construct(protected $confirmpassword){
    $this->confirmpassword = $confirmpassword;
  }

  /**
   * Check if is a number
   *
   * @param null $value
   * @return bool
   */
  function isValid($value = null)
  {
    if(strlen($value) < 8) {
      $this->errorFound();
      $this->msg = 'Your passwords length too short. Please type carefully!';
      return false;
    } elseif ($value != $this->confirmpassword) { 
      $this->errorFound();
      $this->msg = 'Your passwords do not match. Please type carefully!';
      return false;
    }

    return true;
  }

  function getError()
  {
     return "{$this->msg}";
  }
}
