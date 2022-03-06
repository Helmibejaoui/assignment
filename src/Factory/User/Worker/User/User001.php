<?php


namespace App\Factory\User\Worker\User;

use App\Entity\File;
use App\Factory\User\Worker\AbstractWorker;
use App\Helpers\Decoder;
use App\Service\User\PostService;
use Doctrine\ORM\EntityManagerInterface;

class User001 extends AbstractWorker
{
    public function __construct(
        private PostService            $postService,
        private EntityManagerInterface $entityManager,
        private Decoder                $decoder
    )
    {
    }

    public static function getIndex(): string
    {
        return 'USER001';
    }

    public function supports(): bool
    {
        /*
         * Decide if the worker supports this request or not
         */
        return true;
    }

    public function __invoke(string $fileName)
    {
        $result = false;

        $file = $this->entityManager->getRepository(File::class)->findOneBy(array('name' => $fileName));
        $users = $this->decoder->decodeToArray($fileName);
        foreach ($users as $key => $user) {
            if ($key === null || $key > $file->getLastLine()) {
                $result = $this->postService->post($user, $file, $key);
            }
        }
        return $result;
    }
}
