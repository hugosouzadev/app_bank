<?php
namespace Tests;

use Illuminate\Support\Facades\DB;

class TransactionTestCase extends TestCase
{
    protected function assertPreConditions(): void
    {
        parent::assertPreConditions();
        DB::beginTransaction();
    }

    protected function assertPostConditions(): void
    {
        parent::assertPostConditions();
        DB::rollBack();
    }
}