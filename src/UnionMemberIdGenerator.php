<?php

declare(strict_types=1);

namespace Payroll;

class UnionMemberIdGenerator
{
    private static int $id = 10000;


    /**
     * Implementation may vary. A better approach would be to pass
     * a Strategy that holds the logic for generating membership-ids.
     * In case a union has local chapters that need to be reflected in
     * membership ids, a member might have to be passed as an argument to
     * read out the required information.
     * For now, this. will do.
     *
     * @return int
     */
    public static function generate(): int
    {
        return ++self::$id;
    }
}
