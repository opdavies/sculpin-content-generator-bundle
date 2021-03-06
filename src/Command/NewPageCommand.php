<?php

namespace Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Command;

use Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Service\FilenameGenerator;
use Sculpin\Core\Console\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class NewPageCommand extends ContainerAwareCommand {
    use CreateTrait;

    const SUBDIR = '';

    /**
     * {@inheritdoc}
     */
    protected function configure() {
        $this
            ->setName('content:new:page')
            ->setDescription('Create a new page')
            ->addOption(
                'title',
                null,
                InputOption::VALUE_OPTIONAL,
                'The title of the page'
            )
            ->addOption(
                'filename',
                null,
                InputOption::VALUE_OPTIONAL,
                'The name of the file to generate'
            )
            ->addOption(
                'extension',
                null,
                InputOption::VALUE_OPTIONAL,
                'The file extension to use'
            )
            ->addOption(
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Overwrite the file if it already exists'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        // Generate the template content.
        $content = <<< CONTENT
---
title: {$input->getOption('title')}
layout: default
draft: true
---

CONTENT;

        $this->createFile($input, $output, self::SUBDIR, $content);
    }

    /**
     * {@inheritdoc}
     */
    protected function interact(
        InputInterface $input,
        OutputInterface $output
    ) {
        $io = new SymfonyStyle($input, $output);

        // --title option
        if (!$input->getOption('title')) {
            $input->setOption('title', $io->ask(
                'Enter the title of the page'
            ));
        }

        // --extension option
        if (!$input->getOption('extension')) {
            $input->setOption('extension', $io->choice(
                'Which file extension?',
                ['md', 'html.twig', 'twig', 'html']
            ));
        }

        // --filename option
        if (!$input->getOption('filename')) {
            $generator = new FilenameGenerator($input->getOption('title'));
            $generator->setFileExtension($input->getOption('extension'));

            $input->setOption('filename', $io->ask(
                'Enter the name of the file',
                $generator->getFilename()
            ));
        }
    }
}
