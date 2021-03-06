<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:07
 */

class Conversation extends CoreSql {

    protected $id;
    protected $iddest;
    protected $type;
    protected $status;
    protected $datecreate;
    protected $tag;
    protected $idowner;

    private $messages = [];
    private $destination;

    public function __construct($_id = null)
    {
        parent::__construct();
        if(isset($_id) && is_numeric($_id)){
            $parameter = [
                'LIKE' => [
                    'id' => $_id
                ]
            ];
            $this->setWhereParameter($parameter);
            $this->getOneData();
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
    public function getIddest()
    {
        return $this->iddest;
    }

    /**
     * @param mixed $iddest
     */
    public function setIddest($iddest)
    {
        $this->iddest = $iddest;
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
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param array $messages
     */
    public function setMessages($messages)
    {
        foreach($messages as $id){
            $this->messages[] = new Message($id);
        }
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = new User($destination);
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag()
    {
        $this->tag = uniqid();
    }

    /**
     * @return mixed
     */
    public function getIdowner()
    {
        return $this->idowner;
    }

    /**
     * @param mixed $idowner
     */
    public function setIdowner($idowner)
    {
        $this->idowner = $idowner;
    }

    public function getOwner()
    {
        return new User($this->idowner);
    }

    public function configFormAdd($Auth = null)
    {
        $User = new UserRepository();
        $Routes = Access::getSlugsById();
        return [
            "config" => [
                "method" => "post",
                "action" => $Routes['chat/addconv'],
                "save" => "Draft",
                "submit" => "Send",
                "form_file" => false,
            ],
            "textarea" => [
                "label" => "Message",
                "name" => "message",
                "placeholder" => "Your message"
            ],
            'select' => $User->getSelectSimpleUser($Auth)
        ];
    }


}