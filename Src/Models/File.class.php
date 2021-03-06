<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 05/04/2018
 * Time: 23:40
 */

class File extends CoreSql {

    protected $id;
    protected $name;
    protected $path;
    protected $type;
    protected $comment;
    protected $tag;

    public function __construct($_id = null)
    {
        parent::__construct();
        if(isset($_id) && is_numeric($_id)){
            $target = [
                'id',
                'name',
                'path',
                'type',
                'comment',
                'tag',
            ];
            $parameter = [
                'LIKE' => [
                    'id' => $_id
                ]
            ];
            $this->setWhereParameter($parameter);
            $this->getOneData($target);
        }
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
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     *
     */
    public function setTag()
    {
        $this->tag = uniqid();
    }


    public function configFormAdd() {

    }

}