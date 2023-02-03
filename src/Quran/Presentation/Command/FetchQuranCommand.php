<?php

namespace App\Quran\Presentation\Command;

use App\Quran\Domain\Service\FetchQuranInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchQuranCommand extends Command
{
    protected static $defaultName = 'app:fetch-quran';
    protected static $defaultDescription = 'Fetch quran.';
    private readonly FetchQuranInterface $fetchQuran;

    public function __construct(FetchQuranInterface $fetchQuran)
    {
        parent::__construct();
        $this->fetchQuran = $fetchQuran;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $time_start = microtime(true);

        try {
            $this->fetchQuran->fetch();
        } catch (\Exception $exception) {
            dump($exception);

            return Command::FAILURE;
        }

        $output->writeln('Quran successfully fetched!');
        $output->writeln('Total execution time in seconds: '.(microtime(true) - $time_start));

        return Command::SUCCESS;
    }
}
