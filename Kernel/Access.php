<?php
class Access {
    private $access = [
        "default" => [ // Redirect 404
            "slug" => "404",
            "controller" => "index",
            "action" => "notfound",
            "security" => false
        ],
        "homepage" => [ // TOSLE Homepage
            "slug" => "",
            "controller" => "class",
            "action" => "index",
            "security" => false
        ],
        "bloghome" => [ // Blog  homepage
            "slug" => "blog-homepage",
            "controller" => "blog",
            "action" => "index",
            "security" => false
        ],
        "classhome" => [ // Blog  homepage
            "slug" => "class-homepage",
            "controller" => "class",
            "action" => "index",
            "security" => false
        ],
        "chathome" => [ // Chat  homepage
            "slug" => "messaging",
            "controller" => "chat",
            "action" => "index",
            "security" => false
        ],
        "profilehome" => [ // Profile  homepage
            "slug" => "profile",
            "controller" => "profile",
            "action" => "index",
            "security" => false
        ],
        "signin" => [ // Sign in
            "slug" => "sign-in",
            "controller" => "user",
            "action" => "connect",
            "security" => false
        ],
        "signup" => [ // Sign up
            "slug" => "sign-up",
            "controller" => "user",
            "action" => "register",
            "security" => false
        ],
        "verify" => [ // Verify user
            "slug" => "user-verify",
            "controller" => "user",
            "action" => "verify",
            "security" => false
        ],
        "signout" => [ // Sign out
            "slug" => "sign-out",
            "controller" => "user",
            "action" => "disconnect",
            "security" => false
        ],
        "dashboardhome" => [ // Dashboard homepage
            "slug" => "dashboard-homepage",
            "controller" => "dashboard",
            "action" => "index",
            "security" => 2
        ],
        "dashboard_blog" => [ // Dashboard blog homepage
            "slug" => "dashboard-blog",
            "controller" => "dashboard",
            "action" => "blog",
            "security" => 2
        ],
        "dashboard_lesson" => [ // Dashboard blog homepage
            "slug" => "dashboard-lesson",
            "controller" => "dashboard",
            "action" => "lessons",
            "security" => 2
        ],
        "dashboard_chapter" => [ // Dashboard blog homepage
            "slug" => "dashboard-chapter",
            "controller" => "dashboard",
            "action" => "chapter",
            "security" => 2
        ],
        "add_user" => [ // change status blog
            "slug" => "add-user",
            "controller" => "user",
            "action" => "add",
            "security" => false
        ],
        "view_blog_article" => [ // change status blog
            "slug" => "view-article",
            "controller" => "blog",
            "action" => "view",
            "security" => false
        ],

        "view-newpassword" => [ // change status blog
            "slug" => "view-newpassword",
            "controller" => "user",
            "action" => "getpassword",
            "security" => false
        ],
        "set-newpassword" => [ // change status blog
            "slug" => "set-newpassword",
            "controller" => "user",
            "action" => "setnewpassword",
            "security" => false
        ],
        "view_lesson" => [ // change status blog
            "slug" => "lesson",
            "controller" => "class",
            "action" => "view",
            "security" => false
        ],
        "edit_profile" => [
            "slug" => "edit-profile",
            "controller" => "profile",
            "action" => "edit",
            "security" => false
        ],
        "subscribe_lesson" => [
            "slug" => "subscribe-lesson",
            "controller" => "class",
            "action" => "subscribe",
            "security" => false
        ],
        "dashboard_student" => [
            "slug" => "dashboard-student",
            "controller" => "dashboard",
            "action" => "student",
            "security" => 2
        ],
        "dashboard_stat" => [
            "slug" => "dashboard-statistic",
            "controller" => "dashboard",
            "action" => "stats",
            "security" => 2
        ],
        "chatdraft" => [
            "slug" => "messaging-draft",
            "controller" => "chat",
            "action" => "draft",
            "security" => 1
        ],
        "chattrash" => [
            "slug" => "messaging-trash",
            "controller" => "chat",
            "action" => "viewtrash",
            "security" => 2
        ],
        "comment_signalement" => [
            "slug" => "comment-signalement",
            "controller" => "index",
            "action" => "signalement",
            "security" => false
        ],
        "comment_delete" => [
            "slug" => "delete-comment",
            "controller" => "index",
            "action" => "deletecom",
            "security" => 1
        ],
        "legal_notice" => [
            "slug" => "legal",
            "controller" => "index",
            "action" => "legal",
            "security" => 0
        ]
    ];

    private $backOffice = [
        "blog/status" => 2,
        "blog/add" => 2,
        "blog/edit" => 2,
        "class/add" => 2,
        "class/edit" => 2,

        "class/status" => 2,
        "chapter/add" => 2,
        "chapter/edit" => 2,
        "chapter/status" => 2,
        "chapter/order" => 2,
        "index/config" => false,
        "user/delete" => 2,
        "group/delete" => 2,
        "group/manage" => 2,
        "group/edit" => 2,
        "group/unset" => 2,
        "group/gunset" => 2,
        "group/umanage" => 2,
        "class/follow" => 1,
        "chat/addconv" => 1,
        "chat/trash" => 2,
        "chat/untrash" => 2,
        "chat/delete" => 2,
        "user/editpassword" => 1,
        "user/editaccount" => 1,
    ];

    private $urlFixe = [
        'rss_blog' => 'Tosle/Static/xml/blogfeed.xml',
        'rss_lesson' => 'Tosle/Static/xml/lessonfeed.xml'
    ];

    /**
     * @param string|bool $slug
     * @return array
     * Retourne le tableau correspondant au slug fournit en paramètre
     */
    public function getRoute($slug = false)
    {
        foreach ($this->access as $route){
            if($route["slug"]==$slug){
                return $route;
            }
        }
        return $this->access["default"];
    }

    /**
     * @param string $id
     * @return array
     * Retourne le slug correspond à l'id de celui-ci
     */
    public function getSlug($id)
    {
        foreach ($this->access as $key => $params){
            if($key==$id){
                return $params;
            }
        }
        return $this->access["default"];
    }

    /**
     * @return array
     * Retourne le tableau des slugs
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @return array
     * Retourne le tableau des slugs du backoffice
     */
    public function getBackoffice()
    {
        return $this->backOffice;
    }

    /**
     * @param $route
     * @return int|mixed
     * Permet de savoir si la route fournit existe, sinon on renvoit un -1
     */
    public function getBackOfficeRoute($route)
    {
        if(isset($this->backOffice[$route])){
            return $this->backOffice[$route];
        }
        return -1;
    }

    /**
     * @return array
     * Retourne les urls fixes de notre CMS
     */
    public function getUrlFixe()
    {
        return $this->urlFixe;
    }

    /**
     * @return array
     * Retourne un tableau comprenant toutes les routes du Backoffice et et du front office sous la forme
     * key => chemin
     */
    public static function getSlugsById()
    {
        global $language;
        if(empty($language)){
            $language = "en-EN";
        }
        $Acces = new Access();
        $data = [];
        foreach ($Acces->getAccess() as $key => $value){
            $data[$key] = "".DIRNAME.$value["slug"];
        }
        foreach ($Acces->getBackoffice() as $key => $value){
            $data[$key] = "".DIRNAME.$key;
        }
        foreach ($Acces->getUrlFixe() as $key => $value){
            $data[$key] = $value;
        }
        return $data;
    }

    public static function getPublicSlugs()
    {
        global $language;
        if(empty($language)){
            $language = "en-EN";
        }
        $Acces = new Access();
        $data = [];
        foreach ($Acces->getAccess() as $key => $value){
            if($value['security'] < 2){
                $data[$key] = "/".$value["slug"];
            }
        }
        foreach ($Acces->getUrlFixe() as $key => $value){
            $data[$key] = $value;
        }
        return $data;
    }

    /**
     * @param string $string
     * @return string
     * Permet de retourner une chaine de caractere sous le format URL
     */
    public static function constructUrl($string = "url to encode")
    {
        $search = array('à', 'ä', 'â', 'é', 'è', 'ë', 'ê', 'ï', 'ì', 'î', 'ù', 'û', 'ü', 'ô', 'ö', '&', ' ', '?', '!', 'ç', ';', '/', '.', ',', ':', '(', ')', '=', '\'');
        $replace = array('a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'u', 'u', 'u', 'o', 'o', '', '-', '', '', 'c', '', '-', '', '', '', '', '', '', '-');

        return urlencode(trim(str_ireplace($search, $replace, strtolower((trim($string)))),'-'));
    }
}
