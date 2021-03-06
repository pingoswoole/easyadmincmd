<?php



namespace EasyAdminCmd\upload\trigger;


use think\facade\Db;

/**
 * 保存到数据库
 * Class SaveDb
 * @package EasyAdminCmd\upload\trigger
 */
class SaveDb
{

    /**
     * 保存上传文件
     * @param $tableName
     * @param $data
     */
    public static function trigger($tableName, $data)
    {
        Db::name($tableName)->save($data);
    }

}