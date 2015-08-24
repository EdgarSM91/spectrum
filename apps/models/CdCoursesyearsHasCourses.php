<?php
namespace Modules\Models;
class CdCoursesyearsHasCourses extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $ccyid;

    /**
     *
     * @var integer
     */
    protected $cyid;

    /**
     *
     * @var integer
     */
    protected $cid;

    /**
     *
     * @var string
     */
    protected $city;

    /**
     *
     * @var string
     */
    protected $date;

    /**
     *
     * @var string
     */
    protected $cupo;

    /**
     *
     * @var string
     */
    protected $status;

    /**
     *
     * @var string
     */
    protected $final;

    /**
     * Method to set the value of field ccyid
     *
     * @param integer $ccyid
     * @return $this
     */
    public function setCcyid($ccyid)
    {
        $this->ccyid = $ccyid;

        return $this;
    }

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
     * Method to set the value of field city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Method to set the value of field date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Method to set the value of field cupo
     *
     * @param string $cupo
     * @return $this
     */
    public function setCupo($cupo)
    {
        $this->cupo = $cupo;

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
     * Method to set the value of field final
     *
     * @param string $final
     * @return $this
     */
    public function setFinal($final)
    {
        $this->final = $final;

        return $this;
    }

    /**
     * Returns the value of field ccyid
     *
     * @return integer
     */
    public function getCcyid()
    {
        return $this->ccyid;
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
     * Returns the value of field cid
     *
     * @return integer
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * Returns the value of field city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Returns the value of field date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns the value of field cupo
     *
     * @return string
     */
    public function getCupo()
    {
        return $this->cupo;
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
     * Returns the value of field final
     *
     * @return string
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('cd_coursesYears_has_courses');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'ccyid' => 'ccyid', 
            'cyid' => 'cyid', 
            'cid' => 'cid', 
            'city' => 'city', 
            'date' => 'date', 
            'cupo' => 'cupo', 
            'status' => 'status', 
            'final' => 'final'
        );
    }

}
