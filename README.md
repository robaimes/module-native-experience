# Aimes_NativeExperience

!["Supported Magento Version"][magento-badge] !["Latest Release"][release-badge]

* Compatible with _Magento Open Source_ and _Adobe Commerce_ `2.4.x`
* Compatible with [Hyvä Themes][hyva]

## Features
In a few words, this module aims to provide a more native-like experience for mobile users and generally an improved experience overall.

- [Snackbar](https://mui.com/material-ui/react-snackbar/) / [Toasts](https://spectrum.adobe.com/page/toast/): Frontend messages are moved to a single location (currently the bottom right)
- Low battery level notifications displayed to guests to entice account creation
  - Level configurable from admin (Default: 20%)
- Online / offline notifications

> NOTE: Each feature uses feature detection where possible. Browsers that don't support the necessary features should still work just fine, but the relevant feature(s) will not work.

## Requirements

* Magento Open Source or Adobe Commerce version `2.4.x`

## Installation

Please install this module via Composer. This module is hosted on [Packagist][packagist].

* `composer require aimes/module-native-experience`
* `bin/magento module:enable Aimes_NativeExperience`
* `bin/magento setup:upgrade`

## Preview

### Snackbar / Toasts
![image](https://user-images.githubusercontent.com/4225347/234032348-297e03b9-7a17-4893-ad32-868f21a0b9d9.png)


### Battery Notification
![image](https://user-images.githubusercontent.com/4225347/234032138-6c2ca860-d003-40a9-9aff-74706adb0f16.png)

### Online / Offline notifications
![image](https://user-images.githubusercontent.com/4225347/234032610-c4e23965-ee1a-43b8-a201-4c810acfce9d.png)


## Planned Features & Improvements
- [Share API](https://developer.mozilla.org/en-US/docs/Web/API/Navigator/share) to allow device native sharing capablities (if supported)
- [Service worker](https://developer.mozilla.org/en-US/docs/Web/API/Service_Worker_API) to display a basic offline page
  - Possibly configurable via CMS page
  - It's unnecessary to cache the entire site (in my opinion) whereas providing a simple page to provide contact details in the case the customer has no internet connection is reasonably useful
- Better configuration for battery
  - Enable for guests
  - Enable for registered users
  - Cutomised messaging

## Licence
[GPLv3][gpl] © [Rob Aimes][author]

[magento-badge]:https://img.shields.io/badge/magento-2.3.x%20%7C%202.4.x-orange.svg?logo=magento&style=for-the-badge
[release-badge]:https://img.shields.io/github/v/release/robaimes/module-native-experience
[packagist]:https://packagist.org/packages/aimes/module-native-experience
[gpl]:https://www.gnu.org/licenses/gpl-3.0.en.html
[author]:https://aimes.dev/
[hyva]:https://www.hyva.io/
