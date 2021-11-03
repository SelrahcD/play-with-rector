<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use Container;
use PhpParser\Node;
use PHPStan\Type\ObjectType;
use Rector\Core\NodeManipulator\ClassInsertManipulator;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use TestContext;

final class AddTestContextRector extends AbstractRector
{
    private ClassInsertManipulator $classInsertManipulator;

    public function __construct(ClassInsertManipulator $classInsertManipulator)
    {
        $this->classInsertManipulator = $classInsertManipulator;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('', []);
    }

    public function getNodeTypes(): array
    {
        return [
            Node\Stmt\Class_::class,
        ];
    }

    /**
     * @param Node\Stmt\Class_ $node
     */
    public function refactor(Node $node)
    {
        if (!$this->needsTestContext($node)) {
            return;
        }

        $node->implements[] = new Node\Name(TestContext::class);

        $getContainerMethod = $this->nodeFactory->createPublicMethod('getContainer');

        $getContainerMethod->returnType = new Node\Name(Container::class);
        $getContainerMethod->stmts = [new Node\Stmt\Return_(new Node\Expr\New_(new Node\Name('Container')))];

        $this->classInsertManipulator->addAsFirstMethod($node, $getContainerMethod);

        $callsUsingContainer = $this->betterNodeFinder->find($node, function (Node $node): bool {

            if(!$node instanceof Node\Expr\MethodCall) {
                return false;
            }

            if(!$this->isName($node->name, 'build')) {
                return false;
            }

            foreach ($node->args as $arg) {
                if($this->isObjectType($arg->value, new ObjectType(Container::class))) {
                    return true;
                }
            }

            return false;
        });

        foreach ($callsUsingContainer as $call) {

            if(!$call instanceof Node\Expr\MethodCall) {
                continue;
            }

            $call->name = 'buildWithContext';
            $call->args[0] = new Node\Expr\Variable('this');
        }

        return $node;
    }

    private function needsTestContext(Node|Node\Stmt\Class_ $node): bool
    {
        return !in_array(TestContext::class, $node->implements);
    }
}
