<?php

declare(strict_types=1);

namespace App\Tests\Rector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class ReplaceRenderByCallToTemplatingRenderRectorTest extends AbstractRectorTestCase
{

    /**
     * @dataProvider examples
     */
    public function test(SmartFileInfo $fileInfo): void
    {
        $this->doTestFileInfo($fileInfo);
    }

    public function provideConfigFilePath(): string
    {
       return __DIR__ . '/config/config.php';
    }

    /**
     * @return Iterator<SmartFileInfo>
     */
    public function examples(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }
}
