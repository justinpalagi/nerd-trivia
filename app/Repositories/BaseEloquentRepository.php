<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

abstract class BaseEloquentRepository
{
    /**
     * Start Database Transaction
     * 
     * @return null
     */
    public function startTransaction() 
    {
        DB::beginTransaction();
    }

    /**
     * End Database Transaction
     * 
     * @return null
     */
    public function endTransaction()
    {
        DB::commit();
    }

    /**
     * Rollback Database Transaction
     * 
     * @return null
     */
    public function rollBackTransaction()
    {
        DB::rollBack();
    }
}