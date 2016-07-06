<?php

namespace Kisphp\NewsletterBundle\Entity;

use AppBundle\Utils\Status;
use Doctrine\ORM\Mapping as ORM;
use Finite\StatefulInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="nl_newsletters", options={"collate": "utf8_general_ci", "charset": "utf8"})
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Kisphp\NewsletterBundle\Entity\Repository\NewsletterRepository")
 */
class NewsletterEntity implements StatefulInterface
{
    const STATE_DRAFT = 'draft';
    const STATE_SENT = 'sent';
    const STATE_CANCELED = 'canceled';
    const STATE_PENDING = 'pending';

    /**
     * @var array
     */
    protected $availableStates = [
        self::STATE_DRAFT,
        self::STATE_SENT,
        self::STATE_CANCELED,
        self::STATE_PENDING,
    ];

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
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $registered;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $subject;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=false, options={"default": "Draft"})
     */
    protected $state = self::STATE_DRAFT;

    /**
     * @return string
     */
    public function getFiniteState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setFiniteState($state)
    {
        $this->state = $state;
    }

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
     * @return \DateTime
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * @param \DateTime $registered
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
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
