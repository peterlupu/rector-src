<?php

declare(strict_types=1);

namespace Rector\Visibility\Tests\Rector\ClassConst\ChangeConstantVisibilityRector;

use Iterator;
use Rector\Core\ValueObject\Visibility;
use Rector\Visibility\ValueObject\ClassConstantVisibilityChange;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Rector\Visibility\Rector\ClassConst\ChangeConstantVisibilityRector;
use Rector\Visibility\Tests\Rector\ClassConst\ChangeConstantVisibilityRector\Source\ParentObject;
use Symplify\SmartFileSystem\SmartFileInfo;

final class ChangeConstantVisibilityRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(SmartFileInfo $fileInfo): void
    {
        $this->doTestFileInfo($fileInfo);
    }

    public function provideData(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    /**
     * @return array<string, mixed[]>
     */
    protected function getRectorsWithConfiguration(): array
    {
        return [
            ChangeConstantVisibilityRector::class => [
                ChangeConstantVisibilityRector::CLASS_CONSTANT_VISIBILITY_CHANGES => [
                    new ClassConstantVisibilityChange(ParentObject::class, 'TO_BE_PUBLIC_CONSTANT', Visibility::PUBLIC),
                    new ClassConstantVisibilityChange(
                        ParentObject::class,
                        'TO_BE_PROTECTED_CONSTANT',
                        Visibility::PROTECTED
                    ),
                    new ClassConstantVisibilityChange(
                        ParentObject::class,
                        'TO_BE_PRIVATE_CONSTANT',
                        Visibility::PRIVATE
                    ),
                    new ClassConstantVisibilityChange(
                        'Rector\Visibility\Tests\Rector\ClassConst\ChangeConstantVisibilityRector\Fixture\Fixture2',
                        'TO_BE_PRIVATE_CONSTANT',
                        Visibility::PRIVATE
                    ),
                ],
            ],
        ];
    }
}
