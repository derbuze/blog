<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 19.02.18
 * Time: 23:09
 */

namespace Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct(string $message = "Not found.", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
