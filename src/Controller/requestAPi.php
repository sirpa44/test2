<?php declare(strict_types = 1);

namespace App\Controller;

use App\Repository\UsersRepository;
use App\Service\UserService;
use Symfony\Component\Routing\Annotation\Route;

class requestAPi
{
    protected $userRepository;
    protected $userService;

    public function __construct(UsersRepository $usersRepository, UserService $userService)
    {
        $this->userRepository = $usersRepository;
        $this->userService = $userService;
    }

    /**
     * @Route("/", name="api.home")
     */
    public function requestHandling()
    {
        if ($_GET['request'] == 'findOne') {
            $userInstance = $this->userRepository->findOneBy(['username' => $_GET['name']]);
            $results = $this->userService->UserAsArray($userInstance);
        } elseif ($_GET['request'] == 'findAll') {
            $usersInstance = $this->userRepository->findAll();
            $results = [];
            foreach ($usersInstance as $userInstance) {
                $results[] = $this->userService->UserAsArray($userInstance);
            }
            echo '<pre>';
            var_dump($results);
            echo '</pre>';
        }

    }
}