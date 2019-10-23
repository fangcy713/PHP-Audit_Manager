<?php

/**
 * Created by PhpStorm.
 * User: sven
 */

namespace main\app\test\unit\classes;

use main\app\model\user\UserModel;
use main\app\model\user\PermissionSchemeItemModel;
use main\app\model\user\UserGroupModel;
use main\app\model\project\ProjectModel;
use main\app\model\project\ProjectUserRoleModel;
use main\app\test\BaseDataProvider;

/**
 *  为 PermissionLogicDataProvider 逻辑类提供测试数据
 */
class PermissionLogicDataProvider
{

    public static $insertProjectIdArr = [];

    public static $insertUserIdArr = [];

    public static $insertSchemeIdArr = [];

    public static $insertUserProjectRoleArr = [];

    public static $insertUserGroupIdArr = [];

    /**
     * 生成一条项目记录
     * @param array $info
     * @return array
     * @throws \Exception
     */
    public static function initProject($info = [])
    {
        $row = BaseDataProvider::createProject($info);
        self::$insertProjectIdArr[] = $row['id'];
        return $row;
    }

    /**
     * 初始化用户
     * @param array $info
     * @return array
     * @throws \Exception
     */
    public static function initUser($info=[])
    {
        $user = BaseDataProvider::createUser($info);
        self::$insertUserIdArr[] = $user['uid'];
        return $user;
    }

    /**
     * 生成一条类型方案记录
     * @param array $info
     * @return array
     * @throws \Exception
     */
    public static function initScheme($info = [])
    {
        $row = BaseDataProvider::createPermissionScheme($info);
        self::$insertSchemeIdArr[] = $row['id'];
        return $row;
    }

    public static function initUserProjectRole($uid, $projectId, $roleId)
    {
        $row = BaseDataProvider::createUserProjectRole($uid, $projectId, $roleId);
        self::$insertUserProjectRoleArr[] = $row['id'];
        return $row;
    }

    public static function initUserGroup($uid, $groupId)
    {
        $row = BaseDataProvider::createUserGroup($uid, $groupId);
        self::$insertUserGroupIdArr[] = $row['id'];
        return $row;
    }

    /**
     * 清除项目记录
     */
    public static function clearProject()
    {
        if (!empty(self::$insertProjectIdArr)) {
            $model = new ProjectModel();
            foreach (self::$insertProjectIdArr as $id) {
                $model->deleteById($id);
            }
        }
    }

    /**
     * 清除产生的用户
     * @throws \Exception
     */
    public static function clearUser()
    {
        if (!empty(self::$insertUserIdArr)) {
            $model = new UserModel();
            foreach (self::$insertUserIdArr as $id) {
                $model->deleteById($id);
            }
        }
    }

    /**
     * 清除用户角色数据
     */
    public static function clearUserProjectRole()
    {
        if (!empty(self::$insertUserProjectRoleArr)) {
            $model = new ProjectUserRoleModel();
            foreach (self::$insertUserProjectRoleArr as $id) {
                $model->deleteById($id);
            }
        }
    }

    /**
     * 清除用户组
     */
    public static function clearUserGroup()
    {
        if (!empty(self::$insertUserGroupIdArr)) {
            $model = new UserGroupModel();
            foreach (self::$insertUserGroupIdArr as $id) {
                $model->deleteById($id);
            }
        }
    }

    /**
     * @throws \Exception
     */
    public static function clear()
    {
        self::clearProject();
        self::clearUser();
        self::clearUserProjectRole();
        self::clearUserGroup();
    }
}
