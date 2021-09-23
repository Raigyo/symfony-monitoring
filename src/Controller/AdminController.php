<?php

namespace App\Controller;

use App\Repository\WebsiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(WebsiteRepository $repository)
    {
        $websites = $repository->findAll();
        return $this->render('admin/index.html.twig', [
          "websites" => $websites
        ]);
    }
}
