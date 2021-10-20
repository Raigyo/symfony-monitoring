<?php

namespace App\Command;

use App\Controller\HomeController;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckStatusCommand extends Command
{
    protected static $defaultName = 'check:status';
    protected static $defaultDescription = 'Add a short description for your command';


    public function __construct(RequestStack $requestStack, HomeController $controller, WebsiteRepository $repository, EntityManagerInterface $manager)
    {
      parent::__construct();
      $this->requestStack = $requestStack;
      $this->controller = $controller;
      $this->repository = $repository;
      $this->manager = $manager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }
        $this->requestStack->getSession();
        $this->controller->analyze($this->repository, $this->manager);
        $io->success('All status retrieved! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
