# Sculpin Content Generator Bundle

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

With the bundle enabled, you can now see the additional commands by run the `sculpin` command.

The default one is `content:new:post` that generates posts.

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
