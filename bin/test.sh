#!/bin/sh

# Copy the dumb plugin into the test site
echo 'Copying the dumb plugin'
rsync -a tests/_data/dumb-plugin ~/Volumes/wordpress_tests/wp-content/plugins/

# Copy the library into the dumb plugin
echo 'Copying the library into the dumb plugin'
rsync -a ./ ~/Volumes/wordpress_tests/wp-content/plugins/dumb-plugin/vendor/publishpress/wordpress-pro-plugins-ads/ --exclude .git

echo 'Running the tests'
echo '-------------------------------------------'
vendor/bin/codecept run wpunit