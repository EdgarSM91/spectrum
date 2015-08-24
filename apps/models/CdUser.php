<?php
namespace Modules\Models;
use Phalcon\Mvc\Model\Validator\Email as Email;

class CdUser extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $uid;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $last_name;

    /**
     *
     * @var string
     */
    protected $second_name;

    /**
     *
     * @var string
     */
    protected $sex;

    /**
     *
     * @var string
     */
    protected $phone;

    /**
     *
     * @var string
     */
    protected $username;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $rol;

    /**
     *
     * @var string
     */
    protected $photo;

    /**
     *
     * @var string
     */
    protected $date_creation;

    /**
     *
     * @var string
     */
    protected $status;

    /**
     * Method to set the value of field uid
     *
     * @param integer $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field last_name
     *
     * @param string $last_name
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Method to set the value of field second_name
     *
     * @param string $second_name
     * @return $this
     */
    public function setSecondName($second_name)
    {
        $this->second_name = $second_name;

        return $this;
    }

    /**
     * Method to set the value of field sex
     *
     * @param string $sex
     * @return $this
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Method to set the value of field phone
     *
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Method to set the value of field username
     *
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field rol
     *
     * @param string $rol
     * @return $this
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Method to set the value of field photo
     *
     * @param string $photo
     * @return $this
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Method to set the value of field date_creation
     *
     * @param string $date_creation
     * @return $this
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    /**
     * Method to set the value of field status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Returns the value of field uid
     *
     * @return integer
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Returns the value of field second_name
     *
     * @return string
     */
    public function getSecondName()
    {
        return $this->second_name;
    }

    /**
     * Returns the value of field sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Returns the value of field phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Returns the value of field username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field rol
     *
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Returns the value of field photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Returns the value of field date_creation
     *
     * @return string
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * Returns the value of field status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'uid' => 'uid', 
            'name' => 'name', 
            'last_name' => 'last_name', 
            'second_name' => 'second_name', 
            'sex' => 'sex', 
            'phone' => 'phone', 
            'username' => 'username', 
            'password' => 'password', 
            'email' => 'email', 
            'rol' => 'rol', 
            'photo' => 'photo', 
            'date_creation' => 'date_creation', 
            'status' => 'status'
        );
    }

}
