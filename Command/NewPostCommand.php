<?php

namespace Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Command;

use Sculpin\Core\Console\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NewPostCommand extends ContainerAwareCommand
{
    use CreateTrait;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('content:new:post')
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
        // Generate the template content.
        $content = <<< CONTENT
---
title:
---

CONTENT;

        // TODO: Is there a way to get the directory name from the container
        $this->createFile($input, $output, '_posts', $content);
    }
}
