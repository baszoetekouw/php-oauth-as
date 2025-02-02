<?php

/**
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace fkooman\OAuth\Server\Exception;

class ResourceServerException extends \Exception
{
    private $description;

    public function __construct($message, $description, $code = 0, Exception $previous = null)
    {
        $this->description = $description;
        parent::__construct($message, $code, $previous);
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getResponseCode()
    {
        switch ($this->message) {
            case "invalid_request":
                return 400;
            case "no_token":
            case "invalid_token":
                return 401;
            case "insufficient_scope":
            case "insufficient_entitlement":
                return 403;
            default:
                return 400;
        }
    }

    public function getLogMessage($includeTrace = false)
    {
        $msg = 'Message    : '.$this->getMessage().PHP_EOL.
               'Description: '.$this->getDescription().PHP_EOL;
        if ($includeTrace) {
            $msg .= 'Trace      : '.PHP_EOL.$this->getTraceAsString().PHP_EOL;
        }

        return $msg;
    }
}
