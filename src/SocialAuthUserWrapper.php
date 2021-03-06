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
 * @category  HybridAuth
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright ©2012-2013 Andreas Heigl
 * @license   http://www.opesource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     11.01.13
 * @link      https://github.com/heiglandreas/HybridAuth
 */

namespace PixelpinAuth;

use Hybridauth\Entity\Profile;
use PixelpinAuth\UserInterface;
use SocialConnect\Common\Entity\User;

/**
 * This class works as proxy to the HybridAuth-User-Object
 *
 * @category  HybridAuth
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright ©2012-2013 Andreas Heigl
 * @license   http://www.opesource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     11.01.13
 * @link      https://github.com/heiglandreas/HybridAuth
 */
class SocialAuthUserWrapper implements UserInterface
{
    /**
     * @var \SocialConnect\Common\Entity\User
     */
    private $user;

    public function __construct(User $user)
    {   

        $this->user = $user;
    }

    /**
     * Get the ID of the user
     *
     * @return string
     */
    public function getUID()
    {
        return $this->user->id;
    }

    /**
     * Get the name of the user
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->user->firstname;
    }

    public function getLastname()
    {
        return $this->user->lastname;
    }

    public function getFullname()
    {
        return $this->user->fullname;
    }

    /**
     * Get the eMail-Address of the user
     *
     * @return string
     */
    public function getMail()
    {
        return $this->user->email;
    }

    public function getGender()
    {
        return $this->user->gender;
    }

    public function getPhoneNumber()
    {
        return $this->user->phone;
    }

    public function getBirthdate()
    {
        return $this->user->birthdate;
    }

    public function getAddress()
    {
        return $this->user->address;
    }

    public function getTownCity()
    {
        return $this->user->townCity;
    }

    public function getRegion()
    {
        return $this->user->region;
    }

    public function getPostalCode()
    {
        return $this->user->postalCode;
    }

    public function getCountry()
    {
        return $this->user->country;
    }
    /**
     * Get the language of the user
     *
     * @return string
     */
    public function getLanguage()
    {
        return '';
    }

    /**
     * Get the display-name of the user.
     */
    public function getDisplayName()
    {
        return $this->user->firstname . ' ' . $this->user->lastname;
    }
}
