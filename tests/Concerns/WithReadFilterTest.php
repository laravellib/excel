<?php

namespace codicastudio\Excel\Tests\Concerns;

use codicastudio\Excel\Concerns\Importable;
use codicastudio\Excel\Concerns\WithReadFilter;
use codicastudio\Excel\Tests\TestCase;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PHPUnit\Framework\Assert;

class WithReadFilterTest extends TestCase
{
    /**
     * @test
     */
    public function can_register_custom_read_filter()
    {
        $export = new class implements WithReadFilter {
            use Importable;

            public function readFilter(): IReadFilter
            {
                return new class implements IReadFilter {
                    public function readCell($column, $row, $worksheetName = '')
                    {
                        // Assert read filter is being called.
                        // If assertion is not called, test will fail due to
                        // test having no other assertions.
                        Assert::assertTrue(true);

                        return true;
                    }
                };
            }
        };

        $export->toArray('import-users.xlsx');
    }
}
