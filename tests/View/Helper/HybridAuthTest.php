<?php
/**
 * Copyright (c)2013-2013 heiglandreas
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIBILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category 
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright ©2013-2013 Andreas Heigl
 * @license   http://www.opesource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     12.10.13
 * @link      https://github.com/heiglandreas/
 */

namespace PixelpinAuthTest\View\Helper;

use Mockery as M;
use PixelpinAuth\UserToken;
use PixelpinAuth\View\Helper\HybridAuth;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Helper\Url;

class HybridAuthTest extends \PHPUnit_Framework_TestCase
{
    public function testSettingServiceLocators()
    {
        $token     = M::mock(UserToken::class);
        $urlHelper = M::mock(Url::class);

        $viewHelper = new HybridAuth([], $token, $urlHelper);

        $this->assertAttributeEquals([], 'config', $viewHelper);
        $this->assertAttributeEquals($token, 'token', $viewHelper);
        $this->assertAttributeEquals($urlHelper, 'urlHelper', $viewHelper);
    }

    /**
     * @dataProvider gettingBackendsProvider
     */
    public function testGettingBackends($backend, $expected)
    {
        $token     = M::mock(UserToken::class);
        $urlHelper = M::mock(Url::class);

        $viewHelper = new HybridAuth(['backend' => $backend], $token, $urlHelper);
        $this->assertEquals($expected, $viewHelper->getBackends($backend));

    }

    public function gettingBackendsProvider()
    {
        return array(
            array('backend', array('backend')),
            array(array('backend'), array('backend')),
            array(array('foo', 'bar'), array('foo', 'bar')),
        );
    }
}
