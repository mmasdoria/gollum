<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Query\AST\PathExpression;
use OC\PlatformBundle\Model\ImageInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Image
 * @package OC\PlatformBundle\Entity
 */
class Image implements ImageInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $alt;

    /**
     * @var UploadedFile
     */
    protected $file;

    /**
     * @var string
     */
    protected $tempFilename;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getAlt(): ?string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if (null !== $this->url) {
            $this->tempFilename = $this->url;

            $this->url = null;
            $this->alt = null;
        }
    }

    /**
     * @return string
     */
    public function getUploadDir(): string
    {
        return 'uploads/img';
    }

    /**
     * @return string
     */
    public function getUploadRootDir(): string
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     *
     */
    public function preUpload(): void
    {
        if (null === $this->file) {
            return;
        }

        $this->url = $this->file->guessExtension();

        $this->alt = $this->file->getClientOriginalName();
    }

    /**
     *
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir() . '/' . $this->id . '.' . $this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $this->file->move(
            $this->getUploadRootDir(),
            $this->id . '.' . $this->url
        );
    }

    /**
     *
     */
    public function preRemoveUpload(): void
    {
        $this->tempFilename = $this->getUploadRootDir() . '/' . $this->id . '.' . $this->url;
    }

    /**
     *
     */
    public function removeUpload(): void
    {
        if (file_exists($this->tempFilename)) {

            unlink($this->tempFilename);
        }
    }

    /**
     * @return string
     */
    public function getWebPath():string
    {
        return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
    }

}
