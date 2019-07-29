<?php

namespace PhpTwinfield\ApiConnectors;

use PhpTwinfield\Services\FinderService;
use PhpTwinfield\PaymentMethod;

class PaymentMethodApiConnector extends BaseApiConnector
{
    /**
     * List all Payment methods.
     *
     * @param string $pattern  The search pattern. May contain wildcards * and ?
     * @param int    $field    The search field determines which field or fields will be searched. The available fields
     *                         depends on the finder type. Passing a value outside the specified values will cause an
     *                         error.
     * @param int    $firstRow First row to return, useful for paging
     * @param int    $maxRows  Maximum number of rows to return, useful for paging
     * @param array  $options  The Finder options. Passing an unsupported name or value causes an error. It's possible
     *                         to add multiple options. An option name may be used once, specifying an option multiple
     *                         times will cause an error.
     *
     * @return paymentMethods[] The PaymentMethod codes found.
     */
    public function listAll(
        string $pattern = '*',
        int $field = 0,
        int $firstRow = 1,
        int $maxRows = 100,
        array $options = []
    ): array {
        $response = $this->getFinderService()->searchFinder(FinderService::TYPE_PAYMENT_TYPES, $pattern, $field, $firstRow, $maxRows, $options);

        if ($response->data->TotalRows == 0) {
            return [];
        }

        $paymentMethods = [];
        foreach ($response->data->Items->ArrayOfString as $paymentMethodsArray) {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->setCode($paymentMethodsArray->string[0]);
            $paymentMethod->setName($paymentMethodsArray->string[1]);
            $paymentMethods[] = $paymentMethod;
        }

        return $paymentMethods;
    }
}
