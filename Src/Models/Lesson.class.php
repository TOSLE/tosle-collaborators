<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 05/04/2018
 * Time: 23:27
 */

class Lesson extends CoreSql {

    protected $id;
    protected $title;
    protected $description;
    protected $datecreate;
    protected $status;
    protected $url;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->datecreate;
    }

    /**
     * @param mixed $datecreate
     */
    public function setDateCreate($datecreate)
    {
        $this->datecreate = $datecreate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function configFormAddLesson()
    {
        $slugs = Access::getSlugsById();
        $category = new CategoryRepository;
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"",
                "save"=>"Sauvegarder en brouillon",
                "submit"=>"Enregistrer le nouveau cours",
                "form_file"=>false,
            ],
            "input"=> [
                "title"=>[
                    "type"=>"text",
                    "placeholder"=>"Intitulé du cours",
                    "required"=>true,
                    "maxString"=>100,
                    "label"=>"Renseignez le titre de votre cours"
                ]
            ],
            "textarea" => [
                "label" => "Lesson description",
                "name" => "textarea_lesson",
                "description" => "Un maximum de 500 caractères",
                "placeholder" => "Maximum 500 caractères"
            ],
            'select' => $category->configFormCategory(2),
            "exit" => $slugs["dashboard_lesson"]
        ];
    }

}