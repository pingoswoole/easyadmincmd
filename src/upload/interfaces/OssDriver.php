<?php



namespace EasyAdminCmd\upload\interfaces;

interface OssDriver
{

    public function save($objectName,$filePath);

}