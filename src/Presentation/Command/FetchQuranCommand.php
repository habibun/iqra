<?php

namespace App\Presentation\Command;

use App\Application\Service\QuranService as QuranService;
use App\Domain\FetchQuran;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchQuranCommand extends Command
{
    protected static $defaultName = 'app:fetch-quran';
    protected static $defaultDescription = 'Fetch quran.';
    private FetchQuran $fetchQuran;
    private QuranService $quranService;

    public function __construct(FetchQuran $fetchQuran, QuranService $quranService)
    {
        parent::__construct();
        $this->fetchQuran = $fetchQuran;
        $this->quranService = $quranService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = $this->fetchQuran->fetch();
        $this->quranService->create($data);

        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}
