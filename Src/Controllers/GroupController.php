<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/07/2018
 * Time: 17:09
 */

class GroupController extends CoreController
{
    /**
     * @param $params
     * Permet de supprimer un groupe et les jointures qui lui sont liées
     */
    public function deleteAction($params)
    {
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0])){
            $Group = new GroupRepository($params['URI'][0]);
            $UserGroup = new UserGroup();
            $LessonGroup = new LessonGroup();
            $parameterJoin = [
                'LIKE' => [
                    'groupid' => $Group->getId()
                ]
            ];
            $UserGroup->setWhereParameter($parameterJoin);
            $LessonGroup->setWhereParameter($parameterJoin);
            $UserGroup->delete();
            $LessonGroup->delete();
            $Group->deleteGroup();
        }
        header('Location:'.$this->Routes['dashboard_student']);
    }

    /**
     * @param $params
     * Cette fonction permet d'édité un profile
     */
    public function editAction($params)
    {
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0])){
            $Group = new GroupRepository($params['URI'][0]);
            $View = new View("dashboard", "Dashboard/add_group");
            $configForm = $Group->configFormAdd();
            $file_img = null;
            if(!empty($Group->getFileid())){
                $file_img = $Group->getFileid()->getPath().'/'.$Group->getFileid()->getName();
            }
            $configForm['data_content'] = [
                "name" => $Group->getName(),
                "selectedOption" => $Group->getUserForSelect($Group->getId()),
                "file_img" => $file_img
            ];
            $errors = "";
            if(isset($params['POST']) && !empty($params['POST'])){
                $errors = $Group->addGroup($_FILES, $params["POST"], $Group->getId());
                if($errors === 1){
                    header('Location:'.$this->Routes['dashboard_student']);
                }
            }
            $View->setData("errors", $errors);
            $View->setData("configForm", $configForm);
        }
        $View->setData('controller', "DashboardController");
    }

    /**
     * @param $params
     * Gestion d'un groupe où il est possible de supprimer un utilisateur du groupe
     */
    public function manageAction($params)
    {
        $View = new View("dashboard", "Dashboard/manage_group");
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0])) {
            $Group = new GroupRepository($params['URI'][0]);
            $config = $Group->getGroupManage();
            $errors = "";
            if(key_exists('NO_GROUP', $config)){
                $errors = $config;
                $config = null;
            }
            $View->setData('errors', $errors);
            $View->setData('config', $config);
        }
        $View->setData('controller', "DashboardController");
    }

    /**
     * @param $params
     * Retire un utilisateur du group
     */
    public function unsetAction($params)
    {
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0]) && is_numeric($params['URI'][1])) {
            $UserGroup = new UserGroup();
            $parameter = [
                'LIKE' => [
                    'userid' => $params['URI'][1],
                    'groupid' => $params['URI'][0],
                ]
            ];
            $UserGroup->setWhereParameter($parameter);
            $UserGroup->delete();
        }
        header('Location:'.$this->Routes['group/manage'].'/'.$params['URI'][0]);
    }

    /**
     * @param $params
     * Permet de gérer les groupes d'un utilisateur
     */
    public function umanageAction($params)
    {
        $View = new View("dashboard", "Dashboard/manage_group");
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0])) {
            $Group = new GroupRepository();
            $config = $Group->getUserManage($params['URI'][0]);
            $errors = "";
            if(key_exists('NO_GROUP', $config)){
                $errors = $config;
                $config = null;
            }
            $View->setData('errors', $errors);
            $View->setData('config', $config);
        }
        $View->setData('controller', "DashboardController");
    }

    /**
     * @param $params
     * Suppression d'un utilisateur d'un group et retour sur sa page de gestion
     */
    public function gunsetAction($params)
    {
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0]) && is_numeric($params['URI'][1])) {
            $UserGroup = new UserGroup();
            $parameter = [
                'LIKE' => [
                    'userid' => $params['URI'][1],
                    'groupid' => $params['URI'][0],
                ]
            ];
            $UserGroup->setWhereParameter($parameter);
            $UserGroup->delete();
        }
        header('Location:'.$this->Routes['group/umanage'].'/'.$params['URI'][1]);
    }
}