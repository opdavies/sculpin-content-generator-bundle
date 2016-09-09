<?php

namespace Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

trait CreateTrait
{
    private function createFile(
      InputInterface $input,
      OutputInterface $output,
      $subDir = '',
      $content = ''
    ) {
        $path[] = $this->getContainer()->getParameter('sculpin.source_dir');
        $path[] = $subDir;
        $path[] = $filename = $input->getOption('filename');

        $path = implode(DIRECTORY_SEPARATOR, $path);

        /** @var Filesystem $filesystem */
        $filesystem = $this->getContainer()->get('filesystem');

        if (!$filesystem->exists($path) || $input->getOption('force')) {
            $filesystem->dumpFile($path, $content);

            $output->writeln('<info>' . sprintf('%s has been created.', $filename) . '</info>');
        } else {
            $output->writeln('<error>' . sprintf('%s already exists.', $filename) . '</error>');
        }
    }
}
