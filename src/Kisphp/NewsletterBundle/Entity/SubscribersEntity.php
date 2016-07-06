<?php

namespace Kisphp\NewsletterBundle\Entity;

use AppBundle\Utils\Status;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="nl_subscribers", options={"collate": "utf8_general_ci", "charset": "utf8"})
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Kisphp\NewsletterBundle\Entity\Repository\SubscribersRepository")
 * @UniqueEntity("email")
 */
class SubscribersEntity
{
    /**
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", options={"default": 2})
     */
    protected $status = Status::ACTIVE;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $first_name;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $last_name;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, unique=true)
     */
    protected $email;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $registered;

    /**
     * @ORM\PrePersist()
     */
    public function updateModifiedDatetime()
    {
        $this->setRegistered(new \DateTime());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return \DateTime
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * @param \DateTime $registered
     */
    public function setRegistered(\DateTime $registered)
    {
        $this->registered = $registered;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
