<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 09/04/2018
 * Time: 22:09
 */

class LessonChapter extends CoreSql
{
    protected $id;
    protected $order;
    protected $lessonid;
    protected $chapterid;

    public function __construct()
    {
        parent::__construct();
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
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getLessonId()
    {
        return $this->lessonid;
    }

    /**
     * @param mixed $lessonid
     */
    public function setLessonId($lessonid)
    {
        $this->lessonid = $lessonid;
    }

    /**
     * @return mixed
     */
    public function getChapterId()
    {
        return $this->chapterid;
    }

    /**
     * @param mixed $chapterid
     */
    public function setChapterId($chapterid)
    {
        $this->chapterid = $chapterid;
    }


}