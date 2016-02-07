<?php

namespace Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Command;

use Sculpin\Core\Console\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class NewPostCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('content:post')
            ->setDescription('Create a new post')
            ->addArgument('filename', InputArgument::REQUIRED, 'The name of the file to generate')
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Overwrite the file if it already exists')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $content = <<< CONTENT
---
title:
---

CONTENT;

        $path[] = $this->getContainer()->getParameter('sculpin.source_dir');
        $path[] = '_posts';
        $path[] = $filename = $input->getArgument('filename');
        $path = implode(DIRECTORY_SEPARATOR, $path);

        /** @var Filesystem $filesystem */
        $filesystem = $this->getContainer()->get('filesystem');
        if (!$filesystem->exists($path) || $input->getOption('force')) {
            $filesystem->dumpFile($path, $content);

            $output->writeln('<info>' . sprintf('%s has been created.', $filename) . '</info>');
        }
        else {
            $output->writeln('<error>' . sprintf('%s already exists.', $filename) . '</error>');
        }
    }
}
