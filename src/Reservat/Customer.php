<?php

namespace Reservat;

use Reservat\Interfaces\CustomerInterface;
use Reservat\Core\Interfaces\EntityInterface;

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
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $forename
     */
    public function setForename($forename)
    {
        $this->forename = $forename;
    }

    /**
     * @return string
     */
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
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
            'forename' => $this->forename,
            'surname' => $this->surname,
            'telephone' => $this->telephone,
            'email' => (string)$this->email
        ];
    }
}