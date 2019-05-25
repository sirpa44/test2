<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class ImportCsvCommand extends Command
{
    protected static $defaultName = 'app:import-csv';
    protected $path;
    protected $objectManager;

    public function __construct($path, ObjectManager $objectManager)
    {
        parent::__construct(self::$defaultName);
        $this->path = $path;
        $this->objectManager = $objectManager;
    }


    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setDescription('Import User from a csv file');
    }

    /**
     * Import users in database from csv file
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $iterator = $this->getIterator();

        foreach ($iterator as $user) {
            $dbUser = $this->objectManager
                ->getRepository(User::class)
                ->findOneBy(['username' => $user['Name']]);

            if (!($dbUser instanceOf User)) {
                $dbUser = new User();
            }
            $dbUser->setUsername($user['Name']);
            $dbUser->setBtc($user['BTC']);
            $dbUser->setEth($user['ETH']);
            $dbUser->setLtc($user['LTC']);
            $dbUser->setXrp($user['XRP']);
            $this->objectManager->persist($dbUser);
        }

        $this->objectManager->flush();
        $io = new SymfonyStyle($input, $output);
        $io->success('Users imported successfully.');
    }

    /**
     * Get csv data as iterator.
     *
     * @return \iterable
     */
    protected function getIterator()
    {
        $fileExtension = pathinfo($this->path, PATHINFO_EXTENSION);
        if ($fileExtension !== 'csv' || !file_exists($this->path)) {
            throw new FileNotFoundException('Data file path incorrect.');
        }
        $reader = Reader::createFromPath($this->path);
        $reader->setHeaderOffset(0);
        $header = $reader->getHeader();

        if ($header[1] !== 'Name' || $header[2] !== 'BTC' || $header[3] !== 'ETH' || $header[4] !== 'LTC' || $header[5] !== 'XRP') {
            throw new \UnexpectedValueException('CSV file header incorrectly filled.');
        }
        $iterator = $reader->getIterator();
        $iterator->rewind();
        return $iterator;
    }
}
