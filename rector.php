<?php
declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Rector\ClassMethod\TemplateAnnotationToThisRenderRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Utils\Rector\Rector\ReplaceRenderByCallToTemplatingRenderRector;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PATHS, [__DIR__ . '/src', __DIR__ . '/tests']);

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

    $containerConfigurator->import(SetList::DEAD_CODE);
    $containerConfigurator->import(SetList::CODE_QUALITY);

    $services = $containerConfigurator->services();
    $services->set(TemplateAnnotationToThisRenderRector::class);
    $services->set(ReplaceRenderByCallToTemplatingRenderRector::class);
};