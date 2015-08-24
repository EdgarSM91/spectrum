<?php
namespace Modules\Models;
class CdCategory extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $cgid;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $date_creation;

    /**
     * Method to set the value of field cgid
     *
     * @param integer $cgid
     * @return $this
     */
    public function setCgid($cgid)
    {
        $this->cgid = $cgid;

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
     * Returns the value of field cgid
     *
     * @return integer
     */
    public function getCgid()
    {
        return $this->cgid;
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
     * Returns the value of field date_creation
     *
     * @return string
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'cgid' => 'cgid', 
            'name' => 'name', 
            'date_creation' => 'date_creation'
        );
    }

}
