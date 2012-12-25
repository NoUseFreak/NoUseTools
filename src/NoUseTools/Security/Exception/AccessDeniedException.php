<?php
/*
 * This file is part of the NoUseTools package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NoUseTools\Security\Exception;

/**
 * Exception when a user tries to access something he is not allowed to.
 */
class AccessDeniedException extends SecurityException
{
}
