<?php
namespace Modules\Models;
class Vlistcourses extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $cid;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $permalink;

    /**
     *
     * @var string
     */
    protected $status;

    /**
     *
     * @var string
     */
    protected $date_creation;

    /**
     *
     * @var string
     */
    protected $name_user;

    /**
     *
     * @var string
     */
    protected $name_category;

    /**
     * Method to set the value of field cid
     *
     * @param integer $cid
     * @return $this
     */
    public function setCid($cid)
    {
        $this->cid = $cid;

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
     * Method to set the value of field permalink
     *
     * @param string $permalink
     * @return $this
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;

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
     * Method to set the value of field name_user
     *
     * @param string $name_user
     * @return $this
     */
    public function setNameUser($name_user)
    {
        $this->name_user = $name_user;

        return $this;
    }

    /**
     * Method to set the value of field name_category
     *
     * @param string $name_category
     * @return $this
     */
    public function setNameCategory($name_category)
    {
        $this->name_category = $name_category;

        return $this;
    }

    /**
     * Returns the value of field cid
     *
     * @return integer
     */
    public function getCid()
    {
        return $this->cid;
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
     * Returns the value of field permalink
     *
     * @return string
     */
    public function getPermalink()
    {
        return $this->permalink;
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
     * Returns the value of field date_creation
     *
     * @return string
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * Returns the value of field name_user
     *
     * @return string
     */
    public function getNameUser()
    {
        return $this->name_user;
    }

    /**
     * Returns the value of field name_category
     *
     * @return string
     */
    public function getNameCategory()
    {
        return $this->name_category;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('VListCourses');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'cid' => 'cid', 
            'name' => 'name', 
            'permalink' => 'permalink', 
            'status' => 'status', 
            'date_creation' => 'date_creation', 
            'name_user' => 'name_user', 
            'name_category' => 'name_category'
        );
    }

}
