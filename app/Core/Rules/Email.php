<?php


namespace Core\Rules;


class Email extends AbstractRule implements Checkable
{


  protected $msg;

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
      $this->msg = 'Your email address length too short. Please type carefully!';
      return false;
    } elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) { 
      $this->errorFound();
      $this->msg = 'Your email address invalid. Please type carefully!';
      return false;
    }

    return true;
  }

  function getError()
  {
     return "{$this->msg}";
  }
}
