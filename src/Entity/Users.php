<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $btc;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $eth;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $ltc;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $xrp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getBtc(): ?float
    {
        return $this->btc;
    }

    public function setBtc(?float $btc): self
    {
        $this->btc = $btc;

        return $this;
    }

    public function getEth(): ?float
    {
        return $this->eth;
    }

    public function setEth(?float $eth): self
    {
        $this->eth = $eth;

        return $this;
    }

    public function getLtc(): ?float
    {
        return $this->ltc;
    }

    public function setLtc(?float $ltc): self
    {
        $this->ltc = $ltc;

        return $this;
    }

    public function getXrp(): ?float
    {
        return $this->xrp;
    }

    public function setXrp(?float $xrp): self
    {
        $this->xrp = $xrp;

        return $this;
    }
}
