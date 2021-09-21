<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Website;
use App\Repository\StatusRepository;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(WebsiteRepository $repository, StatusRepository $statusRepo)
    {
        $websites = $repository->findAll();
        $count = count($websites);
        $status = $statusRepo->getLastStatus($count);
        // DD (Dump and Die) displays text on the screen and terminates program execution.
        // If error try: `sudo composer require debug --dev`
        // dd($status);
        return $this->render("home/index.html.twig", [
          "websites" => $websites,
          "status" => $status
        ]);
    }
    /**
     * @Route("/websites/analyze", name="analyze")
     */
    public function analyze(WebsiteRepository $repository, EntityManagerInterface $manager){
      // Retrieve all websites
      $websites = $repository->findAll();
      // Retrieve each status
      foreach($websites as $key => $site){
        $url = $site->getUrl();
        $handle =  curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);
        // dd($code);
        // Create new status entity and record it
        $status = new Status();
        $status->setCode($code)
            ->setReportedAt(new \DateTime())
            ->setWebsite($site);
        // dd($status);
        $manager->persist($status);
      }
      $manager->flush();
      $this->addFlash(
        'success',
        'The diagnosis has been made'
      );
      // Redirect to "home" route
      return $this->redirectToRoute("home");
    }
    /**
     * @Route("/websites/{id}", name="website_show")
     */
    public function show(Website $website) {
      // dd($website);
      return $this->render("home/show.html.twig", [
          "website" => $website
        ]);
    }
}
