<?php

namespace App\Controller\Upload;

use App\Service\Upload\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    #[Route('/upload', name: 'app_upload',methods: ['POST'])]
    public function index(Request $request, PostService $postService): JsonResponse
    {
        $validate = array_diff_key($request->request->all(),
            array('action' => '', 'file_data' => '', 'name' => '', 'file_type' => ''));
        if (sizeof($validate) > 0) {
            return new JsonResponse('error', 422);
        }
        $result = $postService->post($request->request->all());

        if ($result === true) {
            return new JsonResponse('success', 200);
        }
        return new JsonResponse('error', 422);
    }
}
