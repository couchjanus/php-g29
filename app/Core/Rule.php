<?php

namespace Core;

use Core\Rules\{CustomConstraint, Max, Min, Number, Required, Email, Password};

class Rule{

  protected $key;

  protected $constraints = [];

  public function getFieldName(){
    return $this->key;
  }
  public function  __construct($key){
    $this->key = $key;
  }

  public function required()
  {
    $this->constraints[] = new Required();

    return $this;
  }

  public function max($value)
  {
    $this->constraints[] = new Max($value);

    return $this;
  }

  public function min($value)
  {
    $this->constraints[] = new Min($value);

    return $this;
  }

  public function number()
  {
    $this->constraints[] = new Number();

    return $this;
  }


  public function password($value)
  {
    $this->constraints[] = new Password($value);

    return $this;
  }

  public function email()
  {
    $this->constraints[] = new Email();

    return $this;
  }


  public function inject(CustomConstraint $customConstraint)
  {
    $this->constraints[] = $customConstraint;

    return $this;
  }
  public function validate($value)
  {
    foreach ($this->constraints as $constraint){
      if($constraint->isValid($value) === false){
        return false;
      }
    }

    return true;
  }

  public function getConstraints()
  {
    return $this->constraints;
  }
}