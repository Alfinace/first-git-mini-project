<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var entityManager
     */
    private $manager;

    protected static $defaultName = 'app:create-user';


    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, string $name = null)
    {
        parent::__construct($name);
        $this->passwordEncoder = $passwordEncoder;
        $this->manager = $entityManager;
    }
    protected function configure()
    {
        $this
            ->setDescription('Create a new user')
            ->setHelp('This command allows you to create a user...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $helper = $this->getHelper('question');

        $fullname = $helper->ask($input ,$output, new Question('Full name :'));
        $username = $helper->ask($input ,$output, new Question('Username :'));
        $email = $helper->ask($input ,$output, new Question('Email :'));
        $address = $helper->ask($input ,$output, new Question('Address :'));
        $contact = $helper->ask($input ,$output, new Question('Contact :'));
        $password = $helper->ask($input ,$output, new Question('Password :'));

        $user = new User();

        $user->setFullname($fullname);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setAddress($address);
        $user->setContact($contact);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword($user,$password));
        $this->manager->persist($user);
        $this->manager->flush();
        $io->success('One user created! Pass --help to see your options.');

        return 0;
    }
}
