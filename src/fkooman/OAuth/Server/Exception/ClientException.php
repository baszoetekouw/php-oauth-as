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

/**
 * Thrown when the client needs to be informed of an error
 */
class ClientException extends \Exception
{
    private $description;
    private $client;
    private $state;

    public function __construct($message, $description, $client, $state, $code = 0, Exception $previous = null)
    {
        $this->description = $description;
        $this->client = $client;
        $this->state = $state;
        parent::__construct($message, $code, $previous);
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getLogMessage($includeTrace = false)
    {
        $client = $this->getClient();
        $msg = 'Message    : '.$this->getMessage().PHP_EOL.
               'Description: '.$this->getDescription().PHP_EOL.
               'Client     : '.$client['id'].PHP_EOL.
               'State      : '.$this->getState().PHP_EOL;
        if ($includeTrace) {
            $msg .= 'Trace      : '.PHP_EOL.$this->getTraceAsString().PHP_EOL;
        }

        return $msg;
    }
}
