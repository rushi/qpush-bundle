<?php

/**
 * Copyright 2014 Underground Elephant
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package     qpush-bundle
 * @copyright   Underground Elephant 2014
 * @license     Apache License, Version 2.0
 */

namespace Uecode\Bundle\QPushBundle\Tests\MockClient;

/**
 * Mock AWS SDK v3 Client
 * 
 * @codeCoverageIgnore
 *
 * @author Keith Kirk <kkirk@undergroundelephant.com>
 */
class AwsMockClient
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * SDK v2 compatibility method
     */
    public function get($name, $throwAway = false)
    {
        if (!in_array($name, ['Sns', 'Sqs'])) {
            throw new \InvalidArgumentException(
                sprintf('Only supports Sns and Sqs as options, %s given.', $name)
            );
        }

        if ($name == "Sns") {
            return new SnsMockClient;
        }

        return new SqsMockClient;
    }

    /**
     * SDK v3 method for creating SQS client
     */
    public function createSqs()
    {
        return new SqsMockClient;
    }

    /**
     * SDK v3 method for creating SNS client
     */
    public function createSns()
    {
        return new SnsMockClient;
    }
}
