#!/bin/sh

# Copy the dumb plugin into the test site
echo 'Copying the dumb plugin one'
rsync -a tests/_data/dumb-plugin-one ~/DevKinsta/public/php80tests/wp-content/plugins/
echo 'Copying the dumb plugin two'
rsync -a tests/_data/dumb-plugin-two ~/DevKinsta/public/php80tests/wp-content/plugins/

# Copy the library into the dumb plugin
echo 'Copying the library into the dumb plugin one'
rsync -a ./ ~/DevKinsta/public/php80tests/wp-content/plugins/dumb-plugin-one/lib/ --exclude .git --exclude tests --exclude composer.json --exclude composer.lock
cd ~/DevKinsta/public/php80tests/wp-content/plugins/dumb-plugin-one/
composer update

echo 'Copying the library into the dumb plugin two'
rsync -a ./ ~/DevKinsta/public/php80tests/wp-content/plugins/dumb-plugin-two/lib/ --exclude .git --exclude tests --exclude composer.json --exclude composer.lock
cd ~/DevKinsta/public/php80tests/wp-content/plugins/dumb-plugin-two/
composer update
