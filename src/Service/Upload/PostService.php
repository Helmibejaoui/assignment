<?php

namespace App\Service\Upload;


use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;

class PostService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function post(array $file): bool
    {
        $fileData = $file['file_data'];
        $fileName = $file['name'];
        $data = base64_decode(str_replace("data:application/octet-stream;base64,", "", $fileData));
        $file = $this->entityManager->getRepository(File::class)->findOneBy(array('name' => $fileName));
        if ($file && filesize('uploads/' . $fileName) === $file->getSize()) {
            return true;
        }
        file_put_contents('uploads/' . $fileName, $data, FILE_APPEND | LOCK_EX);
        return true;

    }

}