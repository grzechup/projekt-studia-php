<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz
 * Date: 13.01.2019
 * Time: 20:01
 */

class File
{
    private $fileName;
    private $originalFileName;
    private $fileSize;
    private $fileFormat;

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @return mixed
     */
    public function getOriginalFileName()
    {
        return $this->originalFileName;
    }

    /**
     * @param mixed $originalFileName
     */
    public function setOriginalFileName($originalFileName): void
    {
        $this->originalFileName = $originalFileName;
    }

    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @param mixed $fileSize
     */
    public function setFileSize($fileSize): void
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @return mixed
     */
    public function getFileFormat()
    {
        return $this->fileFormat;
    }

    /**
     * @param mixed $fileFormat
     */
    public function setFileFormat($fileFormat): void
    {
        $this->fileFormat = $fileFormat;
    }






}