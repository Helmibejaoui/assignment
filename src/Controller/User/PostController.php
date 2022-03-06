<?php

namespace App\Controller\User;

use App\Message\ProcessNotification;
use App\Service\File\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/users', name: 'app_user_post', methods: ['POST'])]
    public function index(Request $request, PostService $postService, MessageBusInterface $bus): JsonResponse
    {
        $file = @$request->request->all();
        $postService->post($file);
        $bus->dispatch(new ProcessNotification($file));


        return new JsonResponse('user insert done', 200);
    }
}
