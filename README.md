# Sculpin Content Generator Bundle

[![Latest Stable Version](https://poser.pugx.org/opdavies/sculpin-content-generator-bundle/v/stable)](https://packagist.org/packages/opdavies/sculpin-content-generator-bundle) [![Total Downloads](https://poser.pugx.org/opdavies/sculpin-content-generator-bundle/downloads)](https://packagist.org/packages/opdavies/sculpin-content-generator-bundle) [![Latest Unstable Version](https://poser.pugx.org/opdavies/sculpin-content-generator-bundle/v/unstable)](https://packagist.org/packages/opdavies/sculpin-content-generator-bundle) [![License](https://poser.pugx.org/opdavies/sculpin-content-generator-bundle/license)](https://packagist.org/packages/opdavies/sculpin-content-generator-bundle)

Adds additional console commands to automate the creation of new content.

## Installation

### Downloading

Add add the bundle into your `sculpin.json` or `composer.json` file.

```json
"require": {
    "opdavies/sculpin-content/generator-bundle": "~1.0.0"
}
```
Install it by running `sculpin update` or `composer update`.

### Enabling

Now you can register the bundle within the `SculpinKernel` class. If you don’t have on, create one at `app/config/SculpinKernel.php`.

```php
use Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel;

/**
 * Class SculpinKernel
 */
class SculpinKernel extends AbstractKernel
{
    /**
     * {@inheritdoc}
     */
    protected function getAdditionalSculpinBundles()
    {
        return [
            'Opdavies\Sculpin\Bundle\ContentGeneratorBundle\SculpinContentGeneratorBundle'
        ];
    }
}
```

## Usage

With the bundle enabled, you can now see the additional commands by run the `sculpin` command. Currently, only `content:new:post` is added, which generates posts.

The next step for is to allow for the bundle to be extended and to allow for customised templates, and also the ability to add commands for other content types - or ideally load them automatically from `sculpin_content_types`.

### Options

The available options are:

    --title

The title of the post. This will be populated when the template is generated.

If empty, you will be required to enter a title interactively when executing the `content:new:post` command.

    --filename

The name of the file to generate.

If empty, you will be required to enter a title interactively. A default filename will be provided based on the provided title and the current date.

## Author

[Oliver Davies](https://www.oliverdavies.uk) - PHP Developer and Linux System Administrator.
