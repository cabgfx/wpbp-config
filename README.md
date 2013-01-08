# WPBP config

This project decouples the user-supplied parts of WordPress configuration from the defaults in `wp-config.php`, allowing for easily portable WP installations.

It is the configuration leg of the [WordPress Boilerplate tools](http://www.wordpressboilerplate.com/).

## How it works

User-supplied configuration values have been extracted from the base configuration file in WordPress, `wp-config.php`. This allows for plugging in values for database, language, debugging, etc. on a per-environment basis.

## Usage
If you're setting up a **new** project, I strongly recommend you to take the path of least resistance and install all WPBP tools at once. See the main site for more details at [wordpressboilerplate.com](http://www.wordpressboilerplate.com).

However, if you already have an existing project, do this:

1. Download the repo and put the `config` folder in the root directory.
2. The (possibly) tricky part is updating your current `wp-config.php` to enable the aforementioned "pluggable" configuration values.
Essentially, it's just a matter of manually extracting the values, `require`'ing the setup from `config/bootstrap.php` in `wp-config.php` and then inserting the extracted values in each `<environment>.php` file in `config/environments`.

## Work with multiple environments

It's common to restore a database on each of your various (test-)environments, eg. local, staging etc.
However, [WordPress serves pages with embedded absolute URLs based on the absolute site URL configured in your database] [docs], which is not ideal.
Normally, you'd have to manually update two options in the DB on each environment to set the correct hostname.

**WPBP eliminates this by overriding `WP_SITEURL` and `WP_HOME`.**

[docs]: http://codex.wordpress.org/Running_a_Development_Copy_of_WordPress

##### A note about production
`config/environments/production.php` is by default set up to not override the constants, deriving the URL straight from the database. If this is not what you want, you can easily do it yourself — just check `development.php`, for instance.

## Adding more environments
Initially, two environments are setup for you - development and production. Let's say you want to add a staging environment:

1. Duplicate an existing environment file and rename it to something else, eg. `staging.php`.
2. Update `staging.php` with your details.
3. Update `config/bootstrap.php` to load the staging config, given a certain condition (typically just a specific domain):

```php
<?php
// Development
if ($_SERVER['REMOTE_ADDR']=='127.0.0.1') {
  require_once 'environments/development.php';

// Staging
} elseif ($_SERVER['REMOTE_ADDR']=='X.X.X.X') {
  require_once 'environments/staging.php';

// Production
} else {
  require_once 'environments/production.php';
}
?>
```

## A helper for environment-specific stuff

WPBP defines an additional constant, `WPBP_ENV`, which enables you to easily check what environment you're running in.

Example:
I usually don't want to include the Google Analytics script when I work locally, so here's what I do:

```php
<?php if (WPBP_ENV == 'production'): ?>
  <script> … </script>
<?php endif; ?>
```

## `.gitignore` template

The repo also includes a template `.gitignore`. Stick it up your project's root folder, and the WP core files will be ignored, along with other files you don't want to track.

Full credit to [Joe Bartlett (@jdbartlett)](https://gist.github.com/jdbartlett) for the template, originally at [https://gist.github.com/444295]()
