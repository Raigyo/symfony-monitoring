<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Website;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
   public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
      $this->encoder = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {
      $admin = new Admin();
      $admin->setEmail('xxx.xxx.com')
              ->setPassword('xxx');
      $encoded= $this->encoder->hashPassword($admin, $admin->getPassword());
      $admin->setPassword($encoded);
      $manager->persist($admin );

      $website = new Website();
      $website->setName("Youtube")
          ->setUrl("https://youtube.com");
      $manager->persist($website);
      $website = new Website();
      $website->setName("Google")
          ->setUrl("https://google.com");
      $manager->persist($website);
      $website = new Website();
      $website->setName("Github")
          ->setUrl("https://github.com/");
      $manager->persist($website);
      $website = new Website();
      $website->setName("GithubTest")
          ->setUrl("https://github.com/azerty");
      $manager->persist($website);
      $website = new Website();
      $website->setName("GithubTest")
          ->setUrl("https://githubtest.com");
      $manager->persist($website);
      $website = new Website();
      $website->setName("FakeWebsite")
          ->setUrl("https://fakewebsiteazerty.com");
      $manager->persist($website);

      $manager->flush();
    }
}
