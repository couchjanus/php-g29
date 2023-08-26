<?php
namespace Core\Traits;

use Core\{Request};

trait RequestValidator
{
    // use Validator;

    // public function validateWith($validator, Request $request = null)
    // {
    //     $request = $request ?: request();

    //     if (is_array($validator)) {
    //         $validator = $this->getValidationFactory()->make($request->all(), $validator);
    //     }

    //     $validator->validate();

    //     return $request->only(
    //         array_keys($validator->getRules())
    //     );
    // }

    public function validate(Request $request, array $rules)
    {
        // $this->getValidationFactory()
        //      ->make($request->all(), $rules, $messages, $customAttributes)
        //      ->validate();

        // var_dump($request);
                
        $field = implode(array_keys($rules));
        $validator = new Validator([ $field => $request->$field ]);
        
        var_dump($validator);
        
        
        // $rul = explode('|', implode(array_values($rules)));
        // var_dump($rul);
        // var_dump(array_values($rules));

        // $validator = new Validator([  'name' => 'Inani El Houssain']);
        // // Only if required and without length greater or equal than 10 characters
        // $validator->addRule(( new Rule('name'))->required()->min(10));

        var_dump($rules);
        exit;
        // return $request->only(array_keys($rules));
    }

    // public function validateWithBag($errorBag, Request $request, array $rules,
    //                                 array $messages = [], array $customAttributes = [])
    // {
    //     try {
    //         return $this->validate($request, $rules, $messages, $customAttributes);
    //     } catch (ValidationException $e) {
    //         $e->errorBag = $errorBag;

    //         throw $e;
    //     }
    // }



  // protected $data = [];

  // protected $rules = [];

  // protected $isError = false;

  // public function  __construct($data){
  //   $this->data = $data;
  }
