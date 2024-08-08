<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Storage\StorageInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class VichUploaderController extends AbstractController
{
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    #[Route('/download/{filename}', name: 'download_file')]
    public function serveFile(Request $request, array $filename): Response
    {
        $file = $this->storage->resolveUri($filename);

        if (!file_exists($file)) {
            throw $this->createNotFoundException('File not found.');
        }

        $fileObject = new File($file);
        $response = new Response();
        $response->setContent(file_get_contents($file));
        $response->headers->set('Content-Type', $fileObject->getMimeType());
        $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', basename($file)));

        if (!$fileObject->isReadable()) {
            throw $this->createAccessDeniedException('File not readable.');
        }

        return $response;
    }
}