<?php

namespace Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Tests;

use Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Service\FilenameGenerator;

class FilenameTransformerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FilenameGenerator
     */
    private $filenameGenerator;

    /**
     * {@inheritdoc}
     */
    public function setUp() {
        $this->filenameGenerator = new FilenameGenerator();
    }

    public function testGeneratePageFilename()
    {
        $this->filenameGenerator->setTitle('Test page');
        $this->assertEquals($this->filenameGenerator->getFilename(), 'test-page.md');

        $this->filenameGenerator->setFileExtension('html.twig');
        $this->assertEquals($this->filenameGenerator->getFilename(), 'test-page.html.twig');
    }

    public function testGeneratePostFilename() {
        $this->filenameGenerator
            ->setTitle('Test post')
            ->setYear(2016)
            ->setMonth(12)
            ->setDay(23);

        $this->assertEquals($this->filenameGenerator->getFilename(), '2016-12-23-test-post.md');
    }
}
