# WordPress Pro Plugins Ads


## Description

Library for displaying ads for Pro plugins in WordPress.

## Testing

Create a new WordPress installation dedicated for testing.

Make sure to copy the file `.env.testing.dist` as `.env.testing` and update the variables according to your environment.

Install the dependencies using composer:

```shell script
$ composer install
``` 

or 

```shell script
$ composer update
```

Run the script:

```shell script
$ bin/test.sh
```

The scripts were implemented for *nix systems. Not adapted for Windows yet.

## License

License: [GPLv3 or later](http://www.gnu.org/licenses/gpl-3.0.html)
