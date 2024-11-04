
# API Starter Kit
This starter project uses Laravel Framework 11.28.1

# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.2] - 2024-11-04
### Added
- Registration feature test
- Updated composer packages.
- Improved folder naming


## [1.0.1] - 2024-10-19
### Added
- Added SemVer compliant changelog.
- Updated composer packages.

## [1.0.0] - 2024-10-12
### Added
- Pre-defined composer scripts:
    - `composer lint`: Run Laravel Pint in test mode on your code.
    - `composer pint`: Run Laravel Pint in fix mode on your code.
    - `composer stan`: Run PHPStan for static analysis on your code.
    - `composer test`: Run PestPHP on your test suite.

### Changed
- Set the `SESSION_DRIVER` to `array` to enforce stateless behavior in the API.
