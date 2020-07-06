<?php

declare(strict_types=1);

namespace Migrify\ConfigFormatConverter;

use Migrify\ConfigFormatConverter\Exception\NotImplementedYetException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\FileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symplify\SmartFileSystem\SmartFileInfo;

final class ConfigLoader
{
    public function loadContainerBuilderFromFileInfo(SmartFileInfo $smartFileInfo): ContainerBuilder
    {
        $containerBuilder = new ContainerBuilder();

        $loader = $this->createLoaderBySuffix($containerBuilder, $smartFileInfo->getSuffix());
        $loader->load($smartFileInfo->getRealPath());

        return $containerBuilder;
    }

    private function createLoaderBySuffix(ContainerBuilder $containerBuilder, string $suffix): FileLoader
    {
        if ($suffix === 'xml') {
            return new XmlFileLoader($containerBuilder, new FileLocator());
        }

        throw new NotImplementedYetException();
    }
}