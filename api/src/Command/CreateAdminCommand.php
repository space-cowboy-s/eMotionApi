<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'app:create-admin';
    const PHONE = '0612345678';
    const DRIVER_LICENCE = 'XXXX-XXXX-XXXX';
    const BIRTDATE = 'XX-XX-XXXX';
    private $entityManager;
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Add a short description for your command')
            ->addArgument('email', InputArgument::REQUIRED, 'email description')
            ->addArgument('password', InputArgument::REQUIRED, 'password choice');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $io->note(sprintf('Create a User for email: %s', $email));
        $user = new User();
        $user->setEmail($email);
        $encodedPaswword = $this->encoder->encodePassword($user, $password);
        $user->setPassword($encodedPaswword);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPhone(self::PHONE);
        $user->setDriverLicence(self::DRIVER_LICENCE);
        $user->setBirthDate(self::BIRTDATE);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $io->success(sprintf('You have created a User with email: %s', $email));
    }
}