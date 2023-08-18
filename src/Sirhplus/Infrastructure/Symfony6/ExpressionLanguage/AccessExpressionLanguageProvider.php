<?php
namespace Symfony6\ExpressionLanguage;

use Sirhplus\Shared\Service\RoleManagerInterface;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

/**
 * Class AccessExpressionLanguageProvider
 * @package App\ExpressionLanguage
 */
final class AccessExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @param RoleManagerInterface $manager
     */
    public function __construct(private readonly RoleManagerInterface $manager)
    {
    }

    /**
     * @return ExpressionFunction[] An array of Function instances
     */
    public function getFunctions()
    {
        return [
            new ExpressionFunction(
                'hasAccessRight',
                function (array $roles) {
                    return sprintf('$this->manager->hasAccessRight(%s)', $roles);
                },
                function ($attributes, array $roles) {
                    return $this->manager->hasAccessRight($roles);
                }
            ),
        ];
    }
}
