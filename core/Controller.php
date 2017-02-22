<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 12:16 ص
 */

namespace App\Core;


class Controller
{
    protected $validator;
    protected $request;

    /**
     * @return mixed
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param mixed $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
    

}