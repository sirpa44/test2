<?php declare(strict_types = 1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\UsersRepository;
use App\Service\UserService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;

class requestAPi
{
    protected $userRepository;
    protected $userService;
    protected $objectManager;

    public function __construct(UsersRepository $usersRepository, UserService $userService, ObjectManager $objectManager)
    {
        $this->userRepository = $usersRepository;
        $this->userService = $userService;
        $this->objectManager = $objectManager;
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
        } elseif ($_GET['request'] == 'create') {
            $user = $this->userRepository->findOneBy(['username' => $_GET['name']]);
            if ($user instanceof User) {
                throw new \Exception('User alredy exist');
            }
            $user =$this->userService->setNewUser($_GET);
            $this->objectManager->persist($user);
            $this->objectManager->flush();
        }



//        echo '<pre>';
//        var_dump($results);
//        echo '</pre>';
    }
}