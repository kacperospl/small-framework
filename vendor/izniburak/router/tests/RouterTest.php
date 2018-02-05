<?php

class RouterTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        // Clear SCRIPT_NAME because bramus/router tries to guess the subfolder the script is run in
        $_SERVER['SCRIPT_NAME'] = '/index.php';

        // Default request method to GET
        $_SERVER['REQUEST_METHOD'] = 'GET';

        // Default SERVER_PROTOCOL method to HTTP/1.1
        $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
    }

    protected function tearDown()
    {
        // nothing
    }

    public function testInit()
    {
        $this->assertInstanceOf('\Buki\Router', new \Buki\Router());
    }
}
