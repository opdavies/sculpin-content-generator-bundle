<?php

namespace Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Command;

use Sculpin\Core\Console\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class NewPostCommand extends ContainerAwareCommand
{
    use CreateTrait;

    const FILENAME_SEPARATOR = '-';

    // TODO: Is there a way to get the directory name from the container
    const SUBDIR = '_posts';

    const FILETYPE = 'md';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('content:new:post')
            ->setDescription('Create a new post')
            ->addOption(
                'title',
                null,
                InputOption::VALUE_OPTIONAL,
                'The title of the post'
            )
            ->addOption(
                'filename',
                null,
                InputOption::VALUE_OPTIONAL,
                'The name of the file to generate'
            )
            ->addOption(
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Overwrite the file if it already exists'
            )
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
title: {$input->getOption('title')}
layout: default
tags: []
draft: true
---

CONTENT;

        $this->createFile($input, $output, self::SUBDIR, $content);
    }

    /**
     * {@inheritdoc}
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        // --title option
        if (!$input->getOption('title')) {
            $input->setOption('title', $io->ask(
              'Enter the title of the post'
            ));
        }

        // --fieldname option
        if (!$input->getOption('filename')) {
            $date = \DateTime::createFromFormat('U', time())->format('Y-m-d');

            $input->setOption('filename', $io->ask(
                'Enter the name of the file',
                $date . self::FILENAME_SEPARATOR . str_replace(
                    ' ',
                    self::FILENAME_SEPARATOR,
                    strtolower($input->getOption('title'))
                ) . '.' . self::FILETYPE
            ));
        }
    }
}
