# NC HELPER FUNCTIONS CHANGE LOG & HISTORY

This is a super-light WordPress plugin to serve up some custom functions for the [Nursing Clio](http://nursingclio.org) website.

Author: Adam Turner
URL: https://github.com/admturner/nc-functions-wp-plugin

<!-- 
Changelog formatting (http://semver.org/): 

## Major.MinorAddorDeprec.Bugfix YYYY-MM-DD

### Todo (for upcoming changes)
### Security (in case of fixed vulnerabilities)
### Fixed (for any bug fixes)
### Changed (for changes in existing functionality)
### Added (for new features)
### Deprecated (for once-stable features removed in upcoming releases)
### Removed (for deprecated features removed in this release)
-->

---

## 0.3 Unreleased

### Changed

- Clean up metadata on nc_edit_author_caps function

### Added

- Add function to prevent direct access of PHP scripts
- index.php to prevent directory index access
- CHANGELOG.md
- LICENSE.md
- Git management files
- Function to add Google Analytics script to the < head > using the wp_head() action
- README.md
- CONTRIBUTING.md
- Add Google Analytics script to the analytics function

### Removed

- Remove extra PHP close tag

## 0.1 initial 2015-06-02

### Added

- First creation of initial file nc-functions.php
- Function to remove the cabaility 'publish_posts' from the Author role