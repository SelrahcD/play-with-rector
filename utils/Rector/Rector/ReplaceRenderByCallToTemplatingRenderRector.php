<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use App\Infrastructure\Templating\Templating;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Type\ObjectType;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\PostRector\Collector\PropertyToAddCollector;
use Rector\PostRector\ValueObject\PropertyMetadata;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ReplaceRenderByCallToTemplatingRenderRector extends \Rector\Core\Rector\AbstractRector
{


    public function __construct(private PropertyToAddCollector $propertyToAddCollector)
    {
    }

    public function getRuleDefinition(): \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new RuleDefinition(
            'Replace usage of Symfony AbstractController render by a call to Templating render method',
            []
        );
    }

    public function getNodeTypes(): array
    {
        return [
            MethodCall::class
        ];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node)
    {
        $identifier = $node->name;

        if (!$identifier instanceof Node\Identifier) {
            throw new \PHPStan\ShouldNotHappenException();
        }

        if ($identifier->name !== 'render') {
            return;
        }

        $scope = $node->getAttribute(AttributeKey::SCOPE);

        if (!$scope instanceof Scope) {
            return;
        }

        $classReflection = $scope->getClassReflection();

        if (!$classReflection instanceof ClassReflection) {
            return;
        }

        if (!$classReflection->isSubclassOf(AbstractController::class)) {
            return;
        }

        $classLike = $node->getAttribute(AttributeKey::CLASS_NODE);
        if (!$classLike instanceof Class_) {
            throw new ShouldNotHappenException();
        }

        $propertyMetadata = new PropertyMetadata(
            'templating',
            new ObjectType(Templating::class),
            Class_::MODIFIER_PRIVATE
        );
        $this->propertyToAddCollector->addPropertyToClass($classLike, $propertyMetadata);

        $propertyFetch = $this->nodeFactory->createPropertyFetch('this', 'templating');

        return new MethodCall($propertyFetch, 'render', $node->args);
    }
}


//        $scope = $node->getAttribute(AttributeKey::SCOPE);
//
//        if(! $scope instanceof Scope) {
//            return;
//        }
//
//        $classReflection = $scope->getClassReflection();
//
//        if(! $classReflection instanceof ClassReflection) {
//            return;
//        }
//
//        if(! $classReflection->isSubclassOf(AbstractController::class)) {
//            return;
//        }

//        if(!$this->isName($node, "render")) {
//            return;
//        }

//        $node->name = new \PhpParser\Node\Name('mysqli_connect');