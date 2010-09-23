<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2002-2010, Sebastian Bergmann <sb@sebastian-bergmann.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit_Selenium
 * @author     Jan Sorgalla <jan.sorgalla@dotsunited.de>
 * @copyright  2002-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.5.0
 */

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

/**
 * TestCase class that uses Sauce OnDemand to provide
 * the functionality required for web testing.
 *
 * @package    PHPUnit_Selenium
 * @author     Jan Sorgalla <jan.sorgalla@dotsunited.de>
 * @copyright  2002-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.5.0
 */
abstract class PHPUnit_Extensions_SeleniumTestCase_SauceOnDemandTestCase extends PHPUnit_Extensions_SeleniumTestCase
{
    /**
     * @param  array $browser
     * @return PHPUnit_Extensions_SeleniumTestCase_Driver
     * @since  Method available since Release 3.3.0
     */
    protected function getDriver(array $browser)
    {
        if (isset($browser['name'])) {
            if (!is_string($browser['name'])) {
                throw new InvalidArgumentException(
                  'Array element "name" is no string.'
                );
            }
        } else {
            $browser['name'] = '';
        }

        if (isset($browser['browser'])) {
            if (!is_string($browser['browser'])) {
                throw new InvalidArgumentException(
                  'Array element "browser" is no string.'
                );
            }
        } else {
            $browser['browser'] = '';
        }

        if (isset($browser['host'])) {
            if (!is_string($browser['host'])) {
                throw new InvalidArgumentException(
                  'Array element "host" is no string.'
                );
            }
        } else {
            $browser['host'] = 'saucelabs.com';
        }

        if (isset($browser['port'])) {
            if (!is_int($browser['port'])) {
                throw new InvalidArgumentException(
                  'Array element "port" is no integer.'
                );
            }
        } else {
            $browser['port'] = 4444;
        }

        if (isset($browser['timeout'])) {
            if (!is_int($browser['timeout'])) {
                throw new InvalidArgumentException(
                  'Array element "timeout" is no integer.'
                );
            }
        } else {
            $browser['timeout'] = 30;
        }

        if (isset($browser['httpTimeout'])) {
            if (!is_int($browser['httpTimeout'])) {
                throw new InvalidArgumentException(
                  'Array element "httpTimeout" is no integer.'
                );
            }
        } else {
            $browser['httpTimeout'] = 45;
        }

        $driver = new PHPUnit_Extensions_SeleniumTestCase_SauceOnDemandTestCase_Driver;
        $driver->setName($browser['name']);
        $driver->setBrowser($browser['browser']);
        $driver->setHost($browser['host']);
        $driver->setPort($browser['port']);
        $driver->setTimeout($browser['timeout']);
        $driver->setHttpTimeout($browser['httpTimeout']);
        $driver->setTestCase($this);
        $driver->setTestId($this->testId);

        if (isset($browser['username'])) {
            if (!is_string($browser['username'])) {
                throw new InvalidArgumentException(
                  'Array element "username" is no string.'
                );
            }

            $driver->setUsername($browser['username']);
        }

        if (isset($browser['accessKey'])) {
            if (!is_string($browser['accessKey'])) {
                throw new InvalidArgumentException(
                  'Array element "accessKey" is no string.'
                );
            }

            $driver->setAccessKey($browser['accessKey']);
        }

        if (isset($browser['os'])) {
            if (!is_string($browser['os'])) {
                throw new InvalidArgumentException(
                  'Array element "os" is no string.'
                );
            }

            $driver->setOs($browser['os']);
        }

        if (isset($browser['browserVersion'])) {
            if (!is_string($browser['browserVersion'])) {
                throw new InvalidArgumentException(
                  'Array element "browserVersion" is no string.'
                );
            }

            $driver->setBrowserVersion($browser['browserVersion']);
        }

        if (isset($browser['jobName'])) {
            if (!is_string($browser['jobName'])) {
                throw new InvalidArgumentException(
                  'Array element "jobName" is no string.'
                );
            }

            $driver->setJobName($browser['jobName']);
        }

        if (isset($browser['recordVideo'])) {
            if (!is_boolean($browser['recordVideo'])) {
                throw new InvalidArgumentException(
                  'Array element "recordVideo" is no boolean.'
                );
            }

            $driver->setRecordVideo($browser['recordVideo']);
        }

        if (isset($browser['userExtensionsUrl'])) {
            if (!is_string($browser['userExtensionsUrl']) && !is_array($browser['userExtensionsUrl'])) {
                throw new InvalidArgumentException(
                  'Array element "userExtensionsUrl" is no string/array.'
                );
            }

            $driver->setUserExtensionsUrl($browser['userExtensionsUrl']);
        }

        if (isset($browser['firefoxProfileUrl'])) {
            if (!is_string($browser['firefoxProfileUrl'])) {
                throw new InvalidArgumentException(
                  'Array element "firefoxProfileUrl" is no string.'
                );
            }

            $driver->setFirefoxProfileUrl($browser['firefoxProfileUrl']);
        }

        if (isset($browser['maxDuration'])) {
            if (!is_int($browser['maxDuration'])) {
                throw new InvalidArgumentException(
                  'Array element "maxDuration" is no integer.'
                );
            }

            $driver->setMaxDuration($browser['maxDuration']);
        }

        if (isset($browser['idleTimeout'])) {
            if (!is_int($browser['idleTimeout'])) {
                throw new InvalidArgumentException(
                  'Array element "idleTimeout" is no integer.'
                );
            }

            $driver->setIdleTimeout($browser['idleTimeout']);
        }

        $this->drivers[] = $driver;

        return $driver;
    }
}
