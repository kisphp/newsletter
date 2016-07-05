<?php

namespace AppBundle\Services;

use AppBundle\Entity\UserEntity;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserSecurityService
{
    /**
     * @var EncoderFactoryInterface
     */
    protected $securityEncoderFactory;

    /**
     * UsersSecurityService constructor.
     *
     * @param EncoderFactoryInterface $securityEncoderFactory
     */
    public function __construct($securityEncoderFactory)
    {
        $this->securityEncoderFactory = $securityEncoderFactory;
    }

    /**
     * @param UserEntity $entity
     * @param string $password
     *
     * @return string
     */
    public function encodePassword(UserEntity $entity, $password)
    {
        $encoder = $this->securityEncoderFactory->getEncoder($entity);

        return $encoder->encodePassword($password, $entity->getSalt());
    }
}
