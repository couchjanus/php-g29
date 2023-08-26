<?php

namespace Core\Rules;

class Required extends AbstractRule implements Checkable
{
  /**
   * Check if the field is not empty
   *
   * @param null $value
   * @return bool
   */
  function isValid($value = null)
  {
    if($value != null){
      return true;
    }

    $this->errorFound();
    return false;
  }

  /**
   * Get error message
   *
   * @return string
   */
  public function getError()
  {
    return "Value required ";
  }
}
