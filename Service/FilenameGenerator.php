<?php

namespace Opdavies\Sculpin\Bundle\ContentGeneratorBundle\Service;

class FilenameGenerator
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $year;

    /**
     * @var int
     */
    private $month;

    /**
     * @var int
     */
    private $day;

    /**
     * @var string
     */
    private $fileExtension = 'md';

    public function __construct($title = null) {
        $this->title = $title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $fileExtension
     *
     * @return $this
     */
    public function setFileExtension($fileExtension) {
        $this->fileExtension = $fileExtension;

        return $this;
    }

    /**
     * @param int $year
     *
     * @return $this
     */
    public function setYear($year) {
        $this->year = $year;

        return $this;
    }

    /**
     * @param int $month
     *
     * @return $this
     */
    public function setMonth($month) {
        $this->month = $month;

        return $this;
    }

    /**
     * @param int $day
     *
     * @return $this
     */
    public function setDay($day) {
        $this->day = $day;

        return $this;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        $filename = strtolower($this->title);
        $filename = str_replace(' ',  '-', $filename);

        foreach (['day', 'month', 'year'] as $property) {
            // Append any date parts to be beginning of the filename.
            if (!empty($this->{$property})) {
                $filename = "{$this->$property}-" . $filename;
            }
        }

        return "{$filename}." . $this->fileExtension;
    }
}
