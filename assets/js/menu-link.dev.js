(function () {
    'use strict';

    function updateMenuLinks() {
        document.querySelectorAll('.pp-version-notice-menu-config').forEach(function (config) {
            var pluginName = config.dataset.pluginName;

            document.querySelectorAll('a.pp-version-notice-upgrade-menu-item').forEach(function (link) {
                if (link.classList.contains(pluginName)) {
                    link.target = '_blank';
                    link.href = config.dataset.redirectTo;
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', updateMenuLinks);
    } else {
        updateMenuLinks();
    }
}());
