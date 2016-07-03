<?php

namespace Kisphp\NewsletterBundle\Entity;

use Kisphp\Admin\MainBundle\Utils\Strings;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kisphp\Admin\MainBundle\Utils\Status;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\Table(name="users", options={"collate": "utf8_general_ci", "charset": "utf8"})
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Kisphp\Admin\MainBundle\Entity\Repository\UsersRepository")
 * @UniqueEntity("email")
 * @ORM\DiscriminatorColumn(name="dtype", type="string")
 * @ORM\DiscriminatorMap({"1" = "UsersEntity", "2" = "UsersAdminEntity"})
 */
class UserEntity implements UserInterface
{

}