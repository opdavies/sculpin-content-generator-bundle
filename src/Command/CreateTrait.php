<?php

namespace Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

trait CreateTrait
{
    /**
     * Create a new file.
     *
     * @param InputInterface $input
     *   The input instance.
     * @param OutputInterface $output
     *   The output instance.
     * @param string $subDir
     *   The parent directories for the file.
     * @param string $content
     *   The file contents.
     */
    private function createFile(
        InputInterface $input,
        OutputInterface $output,
        $subDir = '',
        $content = ''
    ) {
        $path = $this->getFilePath($input, $subDir);
        $this->writeFile($input, $output, $path, $content);
    }

    /**
     * Generate the name and path for the new file.
     *
     * @param InputInterface $input
     *   The input instance.
     * @param string $subDir
     *   The sub-directory to place the file in.
     *
     * @return string
     *   The absolute path for the new file.
     */
    private function getFilePath(InputInterface $input, $subDir)
    {
        $path = [];

        $path[] = $this->getContainer()->getParameter('sculpin.source_dir');
        $path[] = $subDir;
        $path[] = $input->getOption('filename');

        return implode(DIRECTORY_SEPARATOR, array_filter($path));
    }

    /**
     * Writes a file to disk.
     *
     * @param InputInterface $input
     *   The input instance.
     * @param OutputInterface $output
     *   The output instance.
     * @param string $path
     *   The path to create.
     * @param string $content
     *   The file contents.
     *
     * @return $this
     */
    private function writeFile(
        InputInterface $input,
        OutputInterface $output,
        $path,
        $content
    ) {
        // A shorter path to the new file, relative to the site root.
        $shortPath = str_replace(getcwd() . '/', '', $path);

        /** @var Filesystem $filesystem */
        $filesystem = $this->getContainer()->get('filesystem');

        if (!$filesystem->exists($path) || $input->getOption('force')) {
            $filesystem->dumpFile($path, $content);

            $output->writeln('<info>' . sprintf('%s has been created.', $shortPath) . '</info>');
        } else {
            $output->writeln('<error>' . sprintf('%s already exists.', $shortPath) . '</error>');
        }

        return $this;
    }
}
