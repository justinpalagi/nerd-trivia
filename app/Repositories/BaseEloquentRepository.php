<?php

namespace App\Repositories;

use App\Repositories\Contracts\IBaseRepository;
use Illuminate\Support\Facades\DB;

abstract class BaseEloquentRepository implements IBaseRepository
{
    /**
     * Start Database Transaction
     * 
     * @return null
     */
    public function startStorageTransaction() 
    {
        DB::beginTransaction();
    }

    /**
     * End Database Transaction
     * 
     * @return null
     */
    public function endStorageTransaction()
    {
        DB::commit();
    }

    /**
     * Rollback Database Transaction
     * 
     * @return null
     */
    public function handleTransactionError()
    {
        DB::rollBack();
    }
}