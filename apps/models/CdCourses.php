<?php
namespace Modules\Models;
class CdCourses extends \Phalcon\Mvc\Model
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
    protected $objective;

    /**
     *
     * @var string
     */
    protected $directed;

    /**
     *
     * @var string
     */
    protected $content;

    /**
     *
     * @var integer
     */
    protected $cgid;

    /**
     *
     * @var string
     */
    protected $status;

    /**
     *
     * @var integer
     */
    protected $uid;

    /**
     *
     * @var integer
     */
    protected $uid_update;

    /**
     *
     * @var string
     */
    protected $date_creation;

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
     * Method to set the value of field objective
     *
     * @param string $objective
     * @return $this
     */
    public function setObjective($objective)
    {
        $this->objective = $objective;

        return $this;
    }

    /**
     * Method to set the value of field directed
     *
     * @param string $directed
     * @return $this
     */
    public function setDirected($directed)
    {
        $this->directed = $directed;

        return $this;
    }

    /**
     * Method to set the value of field content
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

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
     * Method to set the value of field uid_update
     *
     * @param integer $uid_update
     * @return $this
     */
    public function setUidUpdate($uid_update)
    {
        $this->uid_update = $uid_update;

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
     * Returns the value of field objective
     *
     * @return string
     */
    public function getObjective()
    {
        return $this->objective;
    }

    /**
     * Returns the value of field directed
     *
     * @return string
     */
    public function getDirected()
    {
        return $this->directed;
    }

    /**
     * Returns the value of field content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
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
     * Returns the value of field status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
     * Returns the value of field uid_update
     *
     * @return integer
     */
    public function getUidUpdate()
    {
        return $this->uid_update;
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
            'cid' => 'cid', 
            'name' => 'name', 
            'permalink' => 'permalink', 
            'image' => 'image', 
            'description' => 'description', 
            'objective' => 'objective', 
            'directed' => 'directed', 
            'content' => 'content', 
            'cgid' => 'cgid', 
            'status' => 'status', 
            'uid' => 'uid', 
            'uid_update' => 'uid_update', 
            'date_creation' => 'date_creation'
        );
    }

}
