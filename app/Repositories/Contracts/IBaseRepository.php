<?php

namespace App\Repositories\Contracts;

interface IBaseRepository
{
    /** 
     * Start a database transaction
     * 
     * @return void
     */
    public function startStorageTransaction();

    /** 
     * Perform any database transaction completion procedures
     * 
     * @return void
     */
    public function endStorageTransaction();

    /** 
     * Perform any database rollback or error procedures
     * 
     * @return void
     */
    public function handleTransactionError();
}