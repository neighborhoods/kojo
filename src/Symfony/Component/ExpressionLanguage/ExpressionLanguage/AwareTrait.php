<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Symfony\Component\ExpressionLanguage\ExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $SymfonyComponentExpressionLanguageExpressionLanguage;

    public function setSymfonyComponentExpressionLanguageExpressionLanguage(
        ExpressionLanguage $symfonyComponentExpressionLanguageExpressionLanguage
    ): self {
        if ($this->hasSymfonyComponentExpressionLanguageExpressionLanguage()) {
            throw new \LogicException('SymfonyComponentExpressionLanguageExpressionLanguage is already set.');
        }
        $this->SymfonyComponentExpressionLanguageExpressionLanguage = $symfonyComponentExpressionLanguageExpressionLanguage;

        return $this;
    }

    protected function getSymfonyComponentExpressionLanguageExpressionLanguage(): ExpressionLanguage
    {
        if (!$this->hasSymfonyComponentExpressionLanguageExpressionLanguage()) {
            throw new \LogicException('SymfonyComponentExpressionLanguageExpressionLanguage is not set.');
        }

        return $this->SymfonyComponentExpressionLanguageExpressionLanguage;
    }

    protected function hasSymfonyComponentExpressionLanguageExpressionLanguage(): bool
    {
        return isset($this->SymfonyComponentExpressionLanguageExpressionLanguage);
    }

    protected function unsetSymfonyComponentExpressionLanguageExpressionLanguage(): self
    {
        if (!$this->hasSymfonyComponentExpressionLanguageExpressionLanguage()) {
            throw new \LogicException('SymfonyComponentExpressionLanguageExpressionLanguage is not set.');
        }
        unset($this->SymfonyComponentExpressionLanguageExpressionLanguage);

        return $this;
    }
}
