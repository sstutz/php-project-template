<?php

namespace Tests\Unit;

use App\Example;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testBasicTest(): void
    {
        $example = new Example([1, 2]);

        $this->assertCount(2, $example->getList());
    }
}
