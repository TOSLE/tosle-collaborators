<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:10
 */

class Comment extends CoreSql {

    protected $id;
    protected $content;
    protected $tag;
    protected $datecreate;
    protected $dateupdated;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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

    /**
     * @return mixed
     */
    public function getDatecreate()
    {
        return $this->datecreate;
    }

    /**
     * @param mixed $datecreate
     */
    public function setDatecreate($datecreate)
    {
        $this->datecreate = $datecreate;
    }

    /**
     * @return mixed
     */
    public function getDateupdated()
    {
        return $this->dateupdated;
    }

    /**
     * @param mixed $dateupdated
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;
    }





    public function configFormAdd()
    {
        $slugs = Access::getSlugsById();
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"", "submit"=>"Envoyer votre commentaire",
                "secure" => true,
            ],
            "textarea" => [
                "label" => "Nouveau commentaire",
                "name" => "textarea_comment",
                "description" => "Laissez parler votre imagination",
                "placeholder" => "Soyez sûr de ce que vous voulez publier."
            ],
        ];
    }

}