<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerK7Imfni\Shopware_Production_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerK7Imfni/Shopware_Production_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerK7Imfni.legacy');

    return;
}

if (!\class_exists(Shopware_Production_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerK7Imfni\Shopware_Production_KernelDevDebugContainer::class, Shopware_Production_KernelDevDebugContainer::class, false);
}

return new \ContainerK7Imfni\Shopware_Production_KernelDevDebugContainer([
    'container.build_hash' => 'K7Imfni',
    'container.build_id' => '0695262e',
    'container.build_time' => 1625486500,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerK7Imfni');