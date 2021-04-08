<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use App\Entity\User;

class ImportWerkgeversService {

    /**
     * @var MailService
     */
    private $mailService;

    /* @var EntityManagerInterface */

    private $regService;

    public function __construct(RegisterNewUserService $regService, MailService $mailService) {
        $this->regService = $regService;
        $this->mailService = $mailService;
    }

    public function importSheet(Worksheet $sheet) {
        $col_names = null;
        foreach ($sheet->getRowIterator() AS /* @var $row Row */ $row) {
            $cellIterator = $row->getCellIterator();
            if ($col_names === null) {
                $col_names = $this->extractColumnNames($cellIterator);
                continue;
            }
            $this->importRow($cellIterator, $col_names);
        }
    }

    private function extractColumnNames($cellIterator) {
        $cellIterator->setIterateOnlyExistingCells(FALSE);
        $col_names = [];
        $i = 0;
        foreach ($cellIterator as $cell) {
            $name = $cell->getValue();
            if ($this->getSetterMethodFromName($name)) {
                $col_names[$i] = $name;
            }
            $i++;
        }
        return $col_names;
    }

    private function getSetterMethodFromName($name) {
        $method = 'set' . str_replace('_', '', $name);
        if (method_exists(User::class, $method)) {
            return $method;
        }
        return false;
    }

    private function importRow($cellIterator, $col_names) {
        $numcols = count($col_names);
        $cellIterator->setIterateOnlyExistingCells(FALSE);
        $i = 0;
        $user = new User();
        foreach ($cellIterator as $cell) {
            if ($i >= $numcols) {
                break;
            }
            $val = $cell->getValue();
            $setter = $this->getSetterMethodFromName($col_names[$i]);
            if ($setter) {
                $user->$setter($val);
            }
            $i++;
        }
        $user->addRol('ROLE_EMPLOYER');
        $user->setPassword($this->generate_string());
        $this->regService->register($user);
    }

    private function generate_string($strength = 16) {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($permitted_chars);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

}
