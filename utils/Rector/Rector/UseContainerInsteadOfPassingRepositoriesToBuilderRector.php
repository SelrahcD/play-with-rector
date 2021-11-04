<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\ObjectType;
use Psr\Container\ContainerInterface;
use Rector\PHPUnit\NodeManipulator\SetUpClassMethodNodeManipulator;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class UseContainerInsteadOfPassingRepositoriesToBuilderRector extends \Rector\Core\Rector\AbstractRector
{

    private array $classMethodPairs = [
        [\CartBuilderWithAMethodForContainer::class, 'existsIn'],
        [\CartBuilderWithAnExistsMethodForContainer::class, 'existsIn'],
        [\CartBuilderWithAnExistsMethodForContainerSetup::class, 'existsIn'],
    ];

    private SetUpClassMethodNodeManipulator $setUpClassMethodNodeManipulator;
    private ReflectionProvider $reflectionProvider;

    public function __construct(SetUpClassMethodNodeManipulator $setUpClassMethodNodeManipulator, ReflectionProvider $reflectionProvider)
    {
        $this->setUpClassMethodNodeManipulator = $setUpClassMethodNodeManipulator;
        $this->reflectionProvider = $reflectionProvider;
    }

    public function getRuleDefinition(): \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new RuleDefinition(
            'Use container instead of repositories in builder',
            []
        );
    }

    /**
     * @inheritDoc
     */
    public function getNodeTypes(): array
    {
        return [Node\Stmt\Class_::class];
    }

    /**
     * @inheritDoc
     * @param Node\Stmt\Class_ $node
     */
    public function refactor(Node $node)
    {
        $needsContainer = false;

        $callsUsingRepository = $this->betterNodeFinder->find($node, function (Node $node): bool {
            if (!$node instanceof Node\Expr\MethodCall) {
                return false;
            }

            foreach ($this->classMethodPairs as [$class, $method]) {

                if($this->isObjectType($node->var, new ObjectType($class)) && $this->isName($node->name, $method)) {
                    return true;
                }

            }

            return false;
        });

        foreach ($callsUsingRepository as $call) {
            if (!$call instanceof Node\Expr\MethodCall) {
                continue;
            }

            $type = $this->getType($call->var);

            if(! $type instanceof FullyQualifiedObjectType) {
                var_dump($type);
                continue;
            }

            $allMethods = $this->reflectionProvider
                ->getClass($type->getClassName())
                ->getNativeReflection()
                ->getMethods();



            $containerMethod = $this->findMethodUsingContainer($allMethods);

            if(!$containerMethod instanceof \ReflectionMethod) {
                continue;
            }

            $needsContainer = true;

            $call->name = new Node\Identifier($containerMethod->getName());
            $call->args = [
                $this->nodeFactory->createPropertyFetch('this', 'container')
            ];

        }

        if ($needsContainer) {
            $this->setUpClassMethodNodeManipulator->decorateOrCreate(
                $node,
                [
                    $this->nodeFactory->createPropertyAssignmentWithExpr('container', new Node\Expr\New_(new Node\Name(\InMemoryContainer::class)))
                ]
            );
        }

        return $node;
    }

    /**
     * @param \ReflectionMethod[] $allMethods
     * @return \ReflectionMethod|null
     */
    private function findMethodUsingContainer(array $allMethods): ?\ReflectionMethod
    {
        foreach ($allMethods as $method) {
            $parameters = $method->getParameters();

            if(count($parameters) !== 1) {
                return null;
            }

            $parameter = $parameters[0];

            if($parameter->getType()->getName() === ContainerInterface::class) {
                return $method;
            }

        }

        return null;
    }
}