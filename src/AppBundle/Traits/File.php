<?php
/**
 * Created by PhpStorm.
 * User: aram
 * Date: 9/8/15
 * Time: 3:37 PM
 */

namespace AppBundle\Traits;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Class File
 * @package AppBundle\Traits
 */
trait File
{
    /**
     * @Assert\Image(
     *     groups={"Registration", "Profile", "Default", "Register"},
     *     minWidth = 400,
     *     minHeight = 400,
     *     mimeTypes = {
     *         "image/png",
     *              "image/jpeg",
     *              "image/jpg",
     *              "image/gif",
     *          },
     *     minWidthMessage = "file.width_extension",
     *     minHeightMessage = "file.height_extension",
     * )
     *
     @Assert\Image(
     *     groups={"logo"},
     *     minWidth = 20,
     *     minHeight = 20,
     *     maxWidth = 50,
     *     maxHeight = 50,
     *     minWidthMessage = "file.category_logo_width_min_extension",
     *     minHeightMessage = "file.category_logo_height_min_extension",
     *     maxWidthMessage = "file.category_logo_width_max_extension",
     *     maxHeightMessage = "file.category_logo_height_max_extension",
     * )
     *
     * @Assert\Image(
     *     groups={"goal", "success_story"},
     *     minWidth = 770,
     *     minHeight = 540,
     *     maxSize="4000000",
     *     mimeTypes = {
     *         "image/png",
     *              "image/jpeg",
     *              "image/jpg",
     *              "image/gif",
     *              "application/pdf",
     *              "application/x-pdf",
     *              "image/vnd-wap-wbmp"
     *          },
     *     minWidthMessage = "file.goal_image_min_width_extension",
     *     minHeightMessage = "file.goal_image_min_height_extension",
     *     mimeTypesMessage = "file.extension_error",
     * )
     */
    protected  $file;

    /**
     * @ORM\Column(name="file_original_name", type="string", length=255, nullable=true)
     * @Groups({"image"})
     */
    protected $fileOriginalName;

    /**
     * @ORM\Column(name="file_name", type="string", length=255, nullable=true)
     * @Groups({"image"})
     */
    protected $fileName;

    /**
     * @var integer
     * @Groups({"image"})
     * @ORM\Column(name="file_size", type="integer", nullable=true)
     */
    protected $fileSize;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set FileOriginalName
     *
     * @param string $fileOriginalName
     * @return $this
     */
    public function setFileOriginalName($fileOriginalName)
    {
        $this->fileOriginalName = $fileOriginalName;

        return $this;
    }

    /**
     * Get fileOriginalName
     *
     * @return string
     */
    public function getFileOriginalName()
    {
        return $this->fileOriginalName;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set fileSize
     *
     * @param integer $fileSize
     * @return $this
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return integer
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * This function is used to return file web path
     *
     * @return string
     */
    public function getDownloadLink()
    {
        return $this->fileName ? '/' . $this->getUploadDir() . '/' . $this->getPath() . '/' . $this->fileName : null;
    }

    /**
     * @return string
     */
    public function getAbsolutePath()
    {
        return $this->getUploadRootDir() . '/' . $this->getPath() .'/';
    }

    /**
     * This function is used to return file web path
     *
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__. '/../../../web/' . $this->getUploadDir();
    }

    /**
     * @return string
     */
    protected function getPath()
    {
        return 'files';
    }

    /**
     * Upload folder name
     *
     * @return string
     */
    protected function getUploadDir()
    {
        return 'uploads';
    }

    /**
     * @ORM\PreRemove
     */
    public function preRemove()
    {
        // get origin file path
        $filePath = $this->getAbsolutePath() . $this->getFileName();

        // check file and remove
        if (file_exists($filePath) && is_file($filePath)){
            unlink($filePath);
        }
    }

    /**
     * @VirtualProperty()
     * @Groups({"image"})
     */
    public function getImageSize()
    {
        //get image size
        $size = @getimagesize($this->getAbsolutePath().$this->getFileName());

        //get image width
        $width = $size[0];

        //get image height
        $height = $size[1];

        return array('width' => $width, 'height' => $height);
    }

}