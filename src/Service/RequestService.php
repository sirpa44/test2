<?php declare(strict_types = 1);

namespace App\Service;


use App\Entity\User;
use App\Repository\UsersRepository;
use Doctrine\Common\Persistence\ObjectManager;

class RequestService
{
    /**
     * @var UsersRepository
     */
    protected $userRepository;
    /**
     * @var UserService
     */
    protected $userService;
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    public function __construct(UsersRepository $usersRepository, UserService $userService, ObjectManager $objectManager)
    {
        $this->userRepository = $usersRepository;
        $this->userService = $userService;
        $this->objectManager = $objectManager;
    }

    /**
     * return an array of one user
     *
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function findOne($data)
    {
        $userInstance = $this->userRepository->findOneBy(['username' => $data['name']]);
        if (!($userInstance instanceof User)) {
            throw new \Exception('user doesn\'t exist');
        }
        $result = $this->userService->UserAsArray($userInstance);
        return $result;
    }

    /**
     * return an array of very user
     *
     * @return array
     */
    public function findAll()
    {
        $usersInstance = $this->userRepository->findAll();
        $result = [];
        foreach ($usersInstance as $userInstance) {
            $result[] = $this->userService->UserAsArray($userInstance);
        }
        return $result;
    }

    /**
     * create new User
     *
     * @return string
     * @throws \Exception
     */
    public function create()
    {
        $user = $this->userRepository->findOneBy(['username' => $_GET['name']]);
        if ($user instanceof User) {
            throw new \Exception('User alredy exist');
        }
        $user =$this->userService->setNewUser($_GET);
        $this->saveUser($user);
        $result = 'user added successfully';
        return $result;
    }

    /**
     * Update a user
     *
     * @return string
     * @throws \Exception
     */
    public function update()
    {
        $user = $this->userRepository->findOneBy(['username' => $_GET['name']]);
        if (!($user instanceof User)) {
            throw new \Exception('User doesn\'t exist');
        }
        $updatedUser = $this->userService->setUserData($user, $_GET);
        $this->saveUser($updatedUser);
        $result = 'user updated successfully';
        return $result;
    }

    /**
     * persist and flush the user
     *
     * @param $user User
     */
    protected function saveUser($user)
    {
        $this->objectManager->persist($user);
        $this->objectManager->flush();
    }
}