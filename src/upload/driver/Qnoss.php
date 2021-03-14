<?php



namespace EasyAdminCmd\upload\driver;

use EasyAdminCmd\upload\FileBase;
use EasyAdminCmd\upload\driver\qnoss\Oss;
use EasyAdminCmd\upload\trigger\SaveDb;

/**
 * 七牛云上传
 * Class Qnoss
 * @package EasyAdminCmd\upload\driver
 */
class Qnoss extends FileBase
{

    /**
     * 重写上传方法
     * @return array|void
     */
    public function save()
    {
        parent::save();
        $upload = Oss::instance($this->uploadConfig)
            ->save($this->completeFilePath, $this->completeFilePath);
        if ($upload['save'] == true) {
            SaveDb::trigger($this->tableName, [
                'upload_type'   => $this->uploadType,
                'original_name' => $this->file->getOriginalName(),
                'mime_type'     => $this->file->getOriginalMime(),
                'file_ext'      => strtolower($this->file->getOriginalExtension()),
                'url'           => $upload['url'],
                'create_time'   => time(),
            ]);
        }
        $this->rmLocalSave();
        return $upload;
    }

}