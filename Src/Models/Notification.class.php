<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:15
 */

class Notification extends CoreSql {

    protected $id;
    protected $name;
    protected $value;
    protected $iddest; /** à véfif */

    public function __construct()
    {
        //parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getIdDest()
    {
        return $this->iddest;
    }

    /**
     * @param mixed $iddest
     */
    public function setIdDest($iddest)
    {
        $this->iddest = $iddest;
    }

    public function configFormAdd()
    {
    }
}