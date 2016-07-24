# User Import/Export plugin for OctoberCMS

[![Codacy](https://img.shields.io/codacy/9f8e598b493241b0be12f6dcc5bf3efc.svg)](https://www.codacy.com/app/vojtasvoboda/oc-userimportexport-plugin)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/g/vojtasvoboda/oc-userimportexport-plugin.svg)](https://scrutinizer-ci.com/g/vojtasvoboda/oc-userimportexport-plugin/?branch=master)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/vojtasvoboda/oc-userimportexport-plugin/blob/master/LICENSE.md)

Allow import or export Users managed by [RainLab.User](http://octobercms.com/plugin/rainlab-user) plugin.

- create hundreds of accounts in a few clicks
- CSV columns auto matching, rest columns can be matched drag and drop
- import avatars from Media folder (see Import avatars section below)

Tested with the last stable OctoberCMS build 349.

## Dependencies

- [RainLab.User](http://octobercms.com/plugin/rainlab-user) plugin

## Installation

1. Install plugin [VojtaSvoboda.UserImportExport](http://octobercms.com/plugin/vojtasvoboda-userimportexport)
2. New menu items Import and Export can be found at User backend management

## Import users

1. Create CSV files
2. Required column is only email. If username not provided, import use email as username. If password not provided, import use username as password.
3. Drag and drop CSV to import field. Imported users are automatically activated.

## Import avatars

Just create `users` folder and insert images with name matching username. E.g. image 12905.jpg for user with username 12905, or image vojta.jpg for user with username vojta.

## Import on Mac

1. Create Excel sheet
2. Save As Windows Comma Separated (it will create CSV with semicolons)
3. Open CSV in Sublime Text and replace all semicolons by commas

## Troubleshooting

Can't import CSV file? Try to save file in CP1250 charset (for example in Sublime Text 2).

## Planned features

- [ ] set avatar directory at import page
- [ ] compatibility with RainLab.Location plugin (automagically extend YAML fields)
- [ ] add Update checkbox, for updating existing records (see RainLab.Blog)
- [ ] add checkbox for avatar image visibility (public/protected)
- [ ] add checkbox for enable user activation

**Feel free to send pullrequest!**

## Contributing

Please send Pull Request to master branch.

## License

User import export plugin is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT) same as OctoberCMS platform.