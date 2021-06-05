<?php

namespace Tests\Unit\A;

use Tests\ApiTestCase;

class FirstTest extends ApiTestCase
{
    /**
     * This is a fake test.
     *
     * The purpose of it is to run first, so as to absorb the bootstrapping time, and provide
     * an accurate estimate of the time taken to run the "actual" first test
     */
    public function testBootstrapTime()
    {
        $this->assertTrue(true);
    }
}
