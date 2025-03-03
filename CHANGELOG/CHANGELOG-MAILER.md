# Changelog

## 4.2.3 - 2024-03-30

### Fixed

- Fixed syntax error in ChangeEmailType action

## 4.2.2 - 2024-03-30

### Added 

- Added element action `BarrelStrength\Sprout\mailer\components\elements\email\actions\ChangeEmailType`

### Fixed

- Improved behavior when adding and removing non-credentialed users from Subscriber List Audience Types
- Improved native field logic so layouts aren’t initialized before subclass is checked
- Fixed logic when checking if a subscriber is subscribed by email

## 4.1.8 - 2024-03-09

### Fixed

- Fixed error triggered in console requests

## 4.1.6 - 2023-11-27

### Added

- Emails with template rendering errors will now be logged as Sent Emails Elements 
- Added error logging for emails that throw an error while rendering templates
- Added `BarrelStrength\Sprout\mailer\mailers\MailerInstructionsTrait`

### Changed

- Improved Mailer Settings behavior around configuring settings
- Improved Reply-To Email field default settings behavior

### Fixed

- Fixed dynamic recipient validation when editing an Email Element
- Fixed issue where Sender and Reply-To Email values were not being populated for Craft sender behavior

## 4.1.5 - 2023-11-05

### Changed

- Improved Transactional Email mailer settings validation

### Fixed

- Updated Audience Field to respect setting that enables/disables audiences
- Updated Audience Recipients to respect setting that enables/disables audiences

## 4.1.1 - 2023-09-14

### Added

- Added Mailer to Email Type settings index

### Changed

- Improves Mailer Settings and Email Type migrations
- Improves sender validation when saving Transactional Email Element
- Updates Mailer Settings to support ENV variables when populating defaults
- Removed editable Mailer Field Layout

## 4.1.0 - 2023-09-05

### Added

- Added support for Craft 4
- Added Audience Element
- Added Email Types to configure email templates, custom fields, mailer settings, and permissions
- Added Subscribers as an overlay to Craft Users 
- Added Subscriber List Data Source
- Added Subscriber List Audience Type
- Added User Group Audience Type
- Added support for additional element index table and sort attributes
- Added `twig/cssinliner-extra` dependency `v3.5`

### Changed

- Updated Simple Message Email Templates to Email Message Email Type
- Updated Custom Email Templates to Custom Templates Email Type
- Merged and refactored Sent Email features into Sent Email module
- Merged and refactored Sprout Lists features into Audience Element
- Subscribers now default to non-credentialed Craft Users
- Updated variable `craft.sproutLists` => `sprout.mailer.audiences`
- Updated Project Config settings from `sprout-lists` => `sprout-module-mailer`
- Updated `league/html-to-markdown` dependency `v5.1`

### Removed

- Removed Subscriber Element in favor of inactive Craft Users
- Removed List Element in favor of Audience Element
- Removed Setting 'Enable custom Email Templates on a per-email basis' in favor of Email Types
- Removed Send Method, CC, and BCC fields
