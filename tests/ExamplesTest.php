<?php

use PHPUnit\Framework\TestCase;

class ExamplesTest extends TestCase
{
    public function testExamples()
    {
        $this->runTestsForFiles(new FilesystemIterator(__DIR__ . '/../examples/'));
    }

    public function testCases()
    {
        $this->runTestsForFiles(new FilesystemIterator(__DIR__ . '/cases/'));
    }

    /**
     * @param SplFileInfo[]|iterable $iterator
     */
    private function runTestsForFiles($iterator)
    {
        foreach ($iterator as $file) {
            if (!$file->isDir()) {
                continue;
            }

            $dir = $file->getRealPath();

            $this->exec($dir, 'compile');
            $output = $this->exec($dir, 'test');

            self::assertEquals('yes', $output, $dir);
        }
    }

    /**
     * @param string $dir
     * @param string $phpFile
     *
     * @return string
     */
    private function exec($dir, $phpFile)
    {
        $command = sprintf('php %s/%s.php', $dir, $phpFile);
        exec($command, $output, $exitCode);
        $outputStr = implode(PHP_EOL, $output);

        self::assertEquals(
            0,
            $exitCode,
            'command ' . $command . PHP_EOL . '---' . PHP_EOL . $outputStr . PHP_EOL . '----'
        );

        return $outputStr;
    }
}
