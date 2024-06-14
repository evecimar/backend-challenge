<?php

namespace Tests\Unit;

use App\Models\FibonacciQuery;
use PHPUnit\Framework\TestCase;

class FibonacciCalculationTest extends TestCase
{
    public function test_fibonacci_calculation_zero()
    {
        $query = new FibonacciQuery(['value' => 0]);
        $result = $query->calculateFibonacci();

        $this->assertEquals(0, $result);
    }

    public function test_fibonacci_calculation_one()
    {
        $query = new FibonacciQuery(['value' => 1]);
        $result = $query->calculateFibonacci();

        $this->assertEquals(1, $result);
    }

    public function test_fibonacci_calculation_larger_number()
    {
        $query = new FibonacciQuery(['value' => 10]);
        $result = $query->calculateFibonacci();

        $this->assertEquals(55, $result);
    }

    public function test_fibonacci_calculation_negative_number()
    {
        $query = new FibonacciQuery(['value' => -5]);
        $result = $query->calculateFibonacci();

        $this->assertEquals(0, $result);
    }
}
