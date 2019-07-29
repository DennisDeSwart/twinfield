<?php

namespace PhpTwinfield\ApiConnectors;

use PhpTwinfield\Services\FinderService;
use PhpTwinfield\CodeName;

class FinderCodeNameConnector extends BaseApiConnector
{
    public function listAll(
        string $type,
        string $pattern = '*',
        int $field = 0,
        int $firstRow = 1,
        int $maxRows = 100,
        array $options = []
    ): array {
        $response = $this->getFinderService()->searchFinder($type, $pattern, $field, $firstRow, $maxRows, $options);

        if ($response->data->TotalRows == 0) {
            return [];
        }

        $codeNames = [];
        foreach ($response->data->Items->ArrayOfString as $codeNameArray) {
            $codeName = new CodeName();
            $codeName->setCode($codeNameArray->string[0]);
            $codeName->setName($codeNameArray->string[1]);
            $codeNames[] = $codeName;
        }

        return $codeNames;
    }
}
