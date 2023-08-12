<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class ExamplesContext implements Context
{
    /** @var KernelInterface */
    private $kernel;

    /** @var Response|null */
    private $response;
    /**
     * @var string
     */
    private $payload;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
}
