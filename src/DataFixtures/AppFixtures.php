<?php
/**
 * Created by PhpStorm.
 * User: xupanjiang
 * Date: 13/07/18
 * Time: 10:39 AM
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@example.com');
        $user->setName('Administrator');
        $encodedPassword = $this->encoder->encodePassword($user, 'abcd');
        $user->setPassword($encodedPassword);
        $manager->persist($user);
        $manager->flush();
    }
}