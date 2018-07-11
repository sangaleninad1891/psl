<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeRepository")
 */
class Type
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="phonetype", type="string", length=255)
     */
    private $phonetype;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set phonetype
     *
     * @param string $phonetype
     *
     * @return Type
     */
    public function setPhonetype($phonetype)
    {
        $this->phonetype = $phonetype;

        return $this;
    }

    /**
     * Get phonetype
     *
     * @return string
     */
    public function getPhonetype()
    {
        return $this->phonetype;
    }
}

