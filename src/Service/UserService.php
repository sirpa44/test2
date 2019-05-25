<?php declare(strict_types = 1);

namespace App\Service;

class UserService
{

    public function UserAsArray($user)
    {
        $user = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'btc' => $user->getBtc(),
            'xrp' => $user->getXrp(),
            'ltc' => $user->getLtc(),
            'eth' => $user->getEth()
        ];
        return $user;
    }
}