<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class TargetPathManagerService
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function saveTargetPath(string $targetPath): void
    {
        $this->requestStack->getSession()->set('_security.target_path', $targetPath);
    }

    public function getTargetPath(): ?string
    {
        return $this->requestStack->getSession()->get('_security.target_path');
    }

    public function removeTargetPath(): void
    {
        $this->requestStack->getSession()->remove('_security.target_path');
    }
}