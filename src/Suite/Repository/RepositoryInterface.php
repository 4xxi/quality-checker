<?php

namespace QC\Suite\Repository;

use QC\Suite\Suite;

/**
 * Interface RepositoryInterface.
 */
interface RepositoryInterface
{
    /**
     * @param string $suite
     *
     * @return Suite
     */
    public function find($suite);
}
