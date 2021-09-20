<?php

namespace App\Controller;

use App\Entity\Website;
use App\Repository\WebsiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(WebsiteRepository $repository)
    {
        $websites = $repository->findAll();
        // DD (Dump and Die) displays text on the screen and terminates program execution.
        // If error try: `sudo composer require debug --dev`
        // dd($websites);
        return $this->render("home/index.html.twig", [
          "websites" => $websites
        ]);
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
