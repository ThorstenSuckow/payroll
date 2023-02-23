<?php

declare(strict_types=1);

namespace Tests\Payroll;

use PHPUnit\Framework\TestCase;
use Payroll\UnionMemberIdGenerator;

class UnionMemberIdGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $pastId = 0;

        $startBoundary = 10;
        $cmpBoundary = 10;

        for ($idCounter = 0; $idCounter < $startBoundary; $idCounter++) {
            $pastId = UnionMemberIdGenerator::generate();
            for ($cmpIdCounter = 0; $cmpIdCounter < $cmpBoundary; $cmpIdCounter++) {
                $this->assertNotSame($pastId, UnionMemberIdGenerator::generate());
            }
        }
    }
}
