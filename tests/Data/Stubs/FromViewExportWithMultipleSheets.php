<?php

namespace codicastudio\Excel\Tests\Data\Stubs;

use Illuminate\Support\Collection;
use codicastudio\Excel\Concerns\Exportable;
use codicastudio\Excel\Concerns\WithMultipleSheets;

class FromViewExportWithMultipleSheets implements WithMultipleSheets
{
    use Exportable;

    /**
     * @var Collection
     */
    protected $users;

    /**
     * @param Collection $users
     */
    public function __construct(Collection $users)
    {
        $this->users = $users;
    }

    /**
     * @return SheetForUsersFromView[]
     */
    public function sheets(): array
    {
        return [
            new SheetForUsersFromView($this->users->forPage(1, 100)),
            new SheetForUsersFromView($this->users->forPage(2, 100)),
            new SheetForUsersFromView($this->users->forPage(3, 100)),
        ];
    }
}
