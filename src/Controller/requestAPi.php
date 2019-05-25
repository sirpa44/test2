<?php declare(strict_types = 1);

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Component\Routing\Annotation\Route;

class requestAPi
{
    protected $userRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->userRepository =$usersRepository;
    }

    /**
     * @Route("/", name="api.home")
     */
    public function requestHandling()
    {
        if ($_GET['requet'] = 'findOne') {
            $userInstance = $this->userRepository->findOneBy(['username' => $_GET['name']]);
            $user = [
                'username' => $userInstance->getUsername(),
                'btc' => $userInstance->getBtc(),
                'xrp' => $userInstance->getXrp(),
                'ltc' => $userInstance->getLtc(),
                'eth' => $userInstance->getEth()
                ];
            var_dump($user);die();
        }

    }
}