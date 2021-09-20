<?php

namespace App\DataFixtures;

use App\Entity\Website;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $website = new Website();
        // $website->setName("Exemple")
        //         ->setUrl("https://fake.url.com");
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
