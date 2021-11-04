<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Utils\Rector\Rector\ReplaceRenderByCallToTemplatingRenderRector;
use Utils\Rector\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector;

return static function (
    ContainerConfigurator $containerConfigurator
): void {
    $services = $containerConfigurator->services();
    $services->set(UseContainerInsteadOfPassingRepositoriesToBuilderRector::class);
};
