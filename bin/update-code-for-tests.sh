#!/bin/sh

# Copy the dumb plugin into the test site
echo 'Copying the dumb plugin one'
rsync -a tests/_data/dumb-plugin-one ~/DevKinsta/public/php80tests/wp-content/plugins/
echo 'Copying the dumb plugin two'
rsync -a tests/_data/dumb-plugin-two ~/DevKinsta/public/php80tests/wp-content/plugins/

# Copy the library into the dumb plugin
echo 'Copying the library into the dumb plugin one'
rsync -a ./ ~/DevKinsta/public/php80tests/wp-content/plugins/dumb-plugin-one/vendor/publishpress/wordpress-version-notices/ --exclude .git --exclude tests
echo 'Copying the library into the dumb plugin two'
rsync -a ./ ~/DevKinsta/public/php80tests/wp-content/plugins/dumb-plugin-two/vendor/publishpress/wordpress-version-notices/ --exclude .git --exclude tests
