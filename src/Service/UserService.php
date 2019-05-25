<?php declare(strict_types = 1);

namespace App\Service;

use App\Entity\User;

class UserService
{

    /**
     * make an array of user data from an instance of user
     *
     * @param $user User
     * @return array
     */
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

    /**
     * create a new user
     *
     * @param $data array
     * @return User
     */
    public function setNewUser($data)
    {
        $user = new User();
        $user->setUsername($data['name']);
        return $this->setUserData($user, $data);
    }

    /**
     * @param $user User
     * @param $data array
     * @return User
     */
    public function setUserData($user, $data)
    {
        if (key_exists('eth', $data)) {
            $user->setEth($data['eth']);
        }
        if (key_exists('ltc', $data)) {
            $user->setLtc($data['ltc']);
        }
        if (key_exists('xrp', $data)) {
            $user->setXrp($data['xrp']);
        }
        if (key_exists('btc', $data)) {
            $user->setBtc($data['btc']);
        }
        return $user;
    }
}