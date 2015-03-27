<?php

namespace Reservat;

use Reservat\Interfaces\CustomerInterface;
use Reservat\Interfaces\EntityInterface;

class Customer implements CustomerInterface, EntityInterface
{
    /**
     * @var string
     */
    protected $forename = null;

    /**
     * @var string
     */
    protected $surname = null;

    /**
     * @var string
     */
    protected $telephone = null;

    /**
     * @var string
     */
    protected $email = null;

    /**
     * Customer entity holds basic information
     *
     * @param $forename
     * @param $surname
     * @param $telephone
     * @param $email
     */
    public function __construct($forename, $surname, $telephone, $email = null)
    {
        $this->forename = $forename;
        $this->surname = $surname;
        $this->telephone = $telephone;
        $this->email = $email;
    }

    /**
     * Returns the customers full name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->forename . ' ' . $this->surname;
    }

    /**
     * Return the customer telephone number
     *
     * @return string
     */
    public function getTelephoneNumber()
    {
        return $this->telephone;
    }

    /**
     * Return a array of elements
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'forename' => (string)$this->forename,
            'surname' => (string)$this->surname,
            'telephone' => (string)$this->telephone,
            'email' => (string)$this->email
        ];
    }
}