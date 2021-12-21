<?php

namespace App\Presentation\Command;

use App\Domain\Service\FetchQuranInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchQuranCommand extends Command
{
    protected static $defaultName = 'app:fetch-quran';
    protected static $defaultDescription = 'Fetch quran.';
    private FetchQuranInterface $fetchQuran;

    public function __construct(FetchQuranInterface $fetchQuran)
    {
        parent::__construct();
        $this->fetchQuran = $fetchQuran;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = $this->fetchQuran->fetch();

        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}
