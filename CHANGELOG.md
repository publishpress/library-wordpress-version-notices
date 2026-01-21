The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

[2.2.0] - 8 Dec, 2025

- Added; Added publishpress/translations package to composer dependencies for improved translation management
- Added: Added translation .mo files for better localization support
- Added: Added composer/class-map-generator as a development dependency
- Changed: Updated PHP version requirement in GitHub Actions workflow from 7.4 to 8.2 to support latest development dependencies
- Changed: Updated composer/composer dependency from ^2.9 to ^2.7 for better compatibility with justinrainbow/json-schema
- Changed: Bumped various development dependencies to their latest compatible versions
- Fixed: Resolved dependency conflicts between composer/composer and codeception/module-rest packages
- Technical: Adjusted version-related tests in VersionsCest.php to match new version number
