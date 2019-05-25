<?php declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class User
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getBtc(): float
    {
        return $this->btc;
    }

    /**
     * @param float $btc
     * @return User
     */
    public function setBtc(float $btc): self
    {
        $this->btc = $btc;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getEth(): float
    {
        return $this->eth;
    }

    /**
     * @param float $eth
     * @return User
     */
    public function setEth(float $eth): self
    {
        $this->eth = $eth;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLtc(): float
    {
        return $this->ltc;
    }

    /**
     * @param float $ltc
     * @return User
     */
    public function setLtc(float $ltc): self
    {
        $this->ltc = $ltc;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getXrp(): float
    {
        return $this->xrp;
    }

    /**
     * @param float $xrp
     * @return User
     */
    public function setXrp(float $xrp): self
    {
        $this->xrp = $xrp;

        return $this;
    }
}
