<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:37
 */

Class Chapter extends CoreSql {

    protected $id;
    protected $title;
    protected $content;
    protected $datecreate;
    protected $status;
    protected $type;
    protected $fileid; /** à vérif */

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
    public function getFileid()
    {
        return $this->fileid;
    }

    /**
     * @param mixed $fileid
     */
    public function setFileid($fileid)
    {
        $this->fileid = $fileid;
    }

    public function configFormAdd()
    {
        $slugs = Access::getSlugsById();
        $category = new CategoryRepository;
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"",
                "submit"=>"Publier le chapitre",
                "save"=>"Sauvegarder en brouillon",
                "form_file"=>true,
            ],
            "input"=> [
                "title"=>[
                    "type"=>"text",
                    "placeholder"=>"Titre du chapitre",
                    "required"=>true,
                    "maxString"=>100,
                    "label"=>"Insert title of your article",
                    "description"=>"Max 100 character"
                ],
                "file"=>[
                    "type"=>"file",
                    "required"=>false,
                    "label"=>"Selectionnez le/les fichiers à joindre à ce chapitre",
                    "format"=>"PDF DOCX DOCM DOTX DOTM XLSX XLSM XLSB XLTM",
                    "description"=>"Authorised format (pdf, docx, docm, dotx, dotm, xlsx, xlsm, xlsb, xltm)",
                    "multiple"=>true
                ]
            ],
            "ckeditor" => [
                "label" => "Edition de votre chapitre",
                "name" => "ckeditor_chapter",
                "description" => "Pas de limite !",
                "placeholder" => "Placeholder"
            ],
            'select_lesson' => $category->configFormCategory(1),
            "exit" => $slugs["dashboard_blog"]
        ];
    }


}