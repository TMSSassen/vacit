<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\ImportWerkgeversService;

class ImportWerkgeversCommand extends Command {

    private $impService;

    public function __construct(ImportWerkgeversService $impService) {
        parent::__construct();
        $this->impService = $impService;
    }

    protected function configure() {
        $this
                ->setName("app:import-spreadsheet")
                ->setDescription("Import Excel Spreadsheet")
                ->setHelp("This command allows you to import a spreadsheet")
                ->addArgument("file", InputArgument::REQUIRED, "Spreadsheet")
        ;
    }

    protected function execute(InputInterface $input,
            OutputInterface $output) {
        $inputFileName = $input->getArgument("file");
        $spreadsheet = IOFactory::load($inputFileName);
        $data = $spreadsheet->getActiveSheet();
        $this->impService->importSheet($data);
        return 0;
    }

}
