<?php
/**
 * Copyright (c) 2012-2013 Andreas Heigl<andreas@heigl.org>
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
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  HybridAuth
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2011-2012 php.ug
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     06.03.2012
 * @link      http://github.com/heiglandreas/php.ug
 */
namespace PixelpinAuth;

use PixelpinAuth\Controller\IndexController;
use PixelpinAuth\Service\HybridAuthFactory;
use PixelpinAuth\Service\IndexControllerFactory;
use PixelpinAuth\Service\SessionFactory;
use PixelpinAuth\Service\UserFactory;
use PixelpinAuth\Service\ViewHelperFactory;
use PixelpinAuth\View\Helper\HybridAuth;
use SocialConnect\Common\Http\Client\ClientInterface;
use SocialConnect\Common\Http\Client\Guzzle;
use SocialConnect\Provider\Session\Session;
use SocialConnect\Provider\Session\SessionInterface;

return [
    'router' => [
        'routes' => [
            'hybridauth' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/authenticate',
                    'defaults' => [
                        '__NAMESPACE__' => 'PixelpinAuth\Controller',
                        'controller' => 'IndexController',
                        'action'     => 'login',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'login' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/login/:provider[/:redirect]',
                            'defaults' => [
                                'action'   => 'login',
                                'redirect' => 'home'
                            ],
                        ],
                    ],
                    'logout' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/logout[/:redirect]',
                            'defaults' => [
                                'action' => 'logout',
                                'redirect' => 'home'
                            ],
                        ],
                    ],
                    'backend' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/backend/:provider[/]',
                            'defaults' => [
                                'action' => 'backend',
                                'redirect' => 'home',
                            ],
                        ],
                    ]
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => IndexControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            'PixelpinAuthSession' => SessionFactory::class,
            'PixelpinAuthBackend' => HybridAuthFactory::class,
            'PixelpinAuthToken' => UserFactory::class,
        ],
        'invokables' => [
            UserWrapperFactory::class => UserWrapperFactory::class,
            ClientInterface::class => Guzzle::class,
            SessionInterface::class => Session::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            HybridAuth::class => ViewHelperFactory::class,
        ],
        'aliases' => [
            'hybridauthinfo' => HybridAuth::class
        ]
    ],
    'PixelpinAuth' => [
        'socialAuth' => [
            'redirectUri' => 'http://www.example.co.uk/authenticate/backend',
            'provider' => [
                'pixelpin' => [
                    'applicationId' => '',
                    'applicationSecret' => '',
                    'scope' => ['openid email profile address phone'],
                ],
            ],
        ],
        'backend'         => 'PixelPin',
        'link'            => '<a class="hybridauth" href="%2$s">%1$s</a>', // Will be either inserted as first parameter into item or simply returned as complete entry
        'item'            => '<li%2$s>%1$s</li>',
        'itemlist'        => '<ul%2$s>%1$s</ul>',
        'logincontainer'  => '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">%1$s<b class="caret"></b></a>%2$s</li>',
        'logoffcontainer' => '<li>%1$s</li>',
        'logoffstring'    => 'Logout %1$s',
        'loginstring'     => 'Login%1$s',
        'listAttribs'     => ' class="dropdown-menu"', // Will be inserted as 2nd parameter into item
        'itemAttribs'     => null, // Will be inserted as 2nd parameter into itemlist
    ]
];
