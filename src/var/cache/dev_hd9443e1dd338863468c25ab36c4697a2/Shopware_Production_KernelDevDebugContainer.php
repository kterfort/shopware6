<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container3XrjAOu\Shopware_Production_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container3XrjAOu/Shopware_Production_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container3XrjAOu.legacy');

    return;
}

if (!\class_exists(Shopware_Production_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container3XrjAOu\Shopware_Production_KernelDevDebugContainer::class, Shopware_Production_KernelDevDebugContainer::class, false);
}

return new \Container3XrjAOu\Shopware_Production_KernelDevDebugContainer([
    'container.build_hash' => '3XrjAOu',
    'container.build_id' => '1338cb74',
    'container.build_time' => 1625486863,
], __DIR__.\DIRECTORY_SEPARATOR.'Container3XrjAOu');
