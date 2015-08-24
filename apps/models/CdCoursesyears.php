<?php
namespace Modules\Models;
class CdCoursesyears extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $cyid;

    /**
     *
     * @var string
     */
    protected $years;

    /**
     *
     * @var string
     */
    protected $date_creation;

    /**
     * Method to set the value of field cyid
     *
     * @param integer $cyid
     * @return $this
     */
    public function setCyid($cyid)
    {
        $this->cyid = $cyid;

        return $this;
    }

    /**
     * Method to set the value of field years
     *
     * @param string $years
     * @return $this
     */
    public function setYears($years)
    {
        $this->years = $years;

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
     * Returns the value of field cyid
     *
     * @return integer
     */
    public function getCyid()
    {
        return $this->cyid;
    }

    /**
     * Returns the value of field years
     *
     * @return string
     */
    public function getYears()
    {
        return $this->years;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('cd_coursesYears');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'cyid' => 'cyid', 
            'years' => 'years', 
            'date_creation' => 'date_creation'
        );
    }

}
