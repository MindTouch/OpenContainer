<?php declare(strict_types=1);
/**
 * OpenContainer - a dependency injection container for PHP
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
 */
namespace modethirteen\OpenContainer\Tests;

use modethirteen\OpenContainer\OpenContainer;

/**
 * Class TestContainer
 * @package modethirteen\OpenContainer\Tests
 */
class DependencyContainer extends OpenContainer implements IDependencyContainer {

    public function __construct() {
        parent::__construct();
        $this->registerType('CircularDependencyOne', CircularDependencyOne::class);
        $this->registerBuilder('CircularDependencyTwo', function(IDependencyContainer $container) : CircularDependencyTwo {
            return new CircularDependencyTwo($container);
        });
        $this->registerBuilder('Instance', function() : array {
            return [];
        });
        $this->registerInstance('Instance', new Instance());
        $this->registerType('PsrCompatibleCircularDependencyOne', PsrCompatibleCircularDependencyOne::class);
        $this->registerType('PsrCompatibleCircularDependencyTwo', PsrCompatibleCircularDependencyTwo::class);
    }
}
