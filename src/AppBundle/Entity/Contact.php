<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 */
class Contact
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
     * @Assert\NotBlank()
     * @ORM\Column(name="fistname", type="string", length=255)
     */
    private $fistname;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="contactnumber", type="string", length=255)
     */
    private $contactnumber;

    /**
     *
     * @ORM\OneToOne(target="Type")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    private $type;

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
     * Set fistname
     *
     * @param string $fistname
     *
     * @return Contact
     */
    public function setFistname($fistname)
    {
        $this->fistname = $fistname;

        return $this;
    }

    /**
     * Get fistname
     *
     * @return string
     */
    public function getFistname()
    {
        return $this->fistname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Contact
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set contactnumber
     *
     * @param string $contactnumber
     *
     * @return Contact
     */
    public function setContactnumber($contactnumber)
    {
        $this->contactnumber = $contactnumber;

        return $this;
    }

    /**
     * Get contactnumber
     *
     * @return string
     */
    public function getContactnumber()
    {
        return $this->contactnumber;
    }


    /**
     * Set type
     *
     * @param \AppBundle\Entity\Type $type
     *
     * @return Contact
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }
}
