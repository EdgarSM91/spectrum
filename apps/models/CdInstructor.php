<?php
namespace Modules\Models;
class CdInstructor extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $inid;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $lastname;

    /**
     *
     * @var string
     */
    protected $secondname;

    /**
     *
     * @var string
     */
    protected $title;

    /**
     *
     * @var string
     */
    protected $image;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var string
     */
    protected $jurisdiction;

    /**
     *
     * @var string
     */
    protected $curriculum;

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
    protected $beginning;

    /**
     *
     * @var string
     */
    protected $sex;

    /**
     * Method to set the value of field inid
     *
     * @param integer $inid
     * @return $this
     */
    public function setInid($inid)
    {
        $this->inid = $inid;

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
     * Method to set the value of field lastname
     *
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Method to set the value of field secondname
     *
     * @param string $secondname
     * @return $this
     */
    public function setSecondname($secondname)
    {
        $this->secondname = $secondname;

        return $this;
    }

    /**
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Method to set the value of field image
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field jurisdiction
     *
     * @param string $jurisdiction
     * @return $this
     */
    public function setJurisdiction($jurisdiction)
    {
        $this->jurisdiction = $jurisdiction;

        return $this;
    }

    /**
     * Method to set the value of field curriculum
     *
     * @param string $curriculum
     * @return $this
     */
    public function setCurriculum($curriculum)
    {
        $this->curriculum = $curriculum;

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
     * Method to set the value of field beginning
     *
     * @param string $beginning
     * @return $this
     */
    public function setBeginning($beginning)
    {
        $this->beginning = $beginning;

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
     * Returns the value of field inid
     *
     * @return integer
     */
    public function getInid()
    {
        return $this->inid;
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
     * Returns the value of field lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Returns the value of field secondname
     *
     * @return string
     */
    public function getSecondname()
    {
        return $this->secondname;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the value of field image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field jurisdiction
     *
     * @return string
     */
    public function getJurisdiction()
    {
        return $this->jurisdiction;
    }

    /**
     * Returns the value of field curriculum
     *
     * @return string
     */
    public function getCurriculum()
    {
        return $this->curriculum;
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
     * Returns the value of field beginning
     *
     * @return string
     */
    public function getBeginning()
    {
        return $this->beginning;
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
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'inid' => 'inid', 
            'name' => 'name', 
            'lastname' => 'lastname', 
            'secondname' => 'secondname', 
            'title' => 'title', 
            'image' => 'image', 
            'description' => 'description', 
            'jurisdiction' => 'jurisdiction', 
            'curriculum' => 'curriculum', 
            'status' => 'status', 
            'date_creation' => 'date_creation', 
            'beginning' => 'beginning', 
            'sex' => 'sex'
        );
    }

}
