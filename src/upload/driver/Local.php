<?php



namespace EasyAdminCmd\upload\driver;

use EasyAdminCmd\upload\FileBase;
use EasyAdminCmd\upload\trigger\SaveDb;

/**
 * 本地上传
 * Class Local
 * @package EasyAdminCmd\upload\driver
 */
class Local extends FileBase
{

    /**
     * 重写上传方法
     * @return array|void
     */
    public function save()
    {
        parent::save();
        SaveDb::trigger($this->tableName, [
            'upload_type'   => $this->uploadType,
            'original_name' => $this->file->getOriginalName(),
            'mime_type'     => $this->file->getOriginalMime(),
            'file_ext'      => strtolower($this->file->getOriginalExtension()),
            'url'           => $this->completeFileUrl,
            'create_time'   => time(),
        ]);
        return [
            'save' => true,
            'msg'  => '上传成功',
            'url'  => $this->completeFileUrl,
        ];
    }

}