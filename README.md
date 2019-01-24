# Before After Repeater Block

A before/after image comparison repeater block for [Dewsign's Nova Repeater Blocks](https://github.com/dewsign/nova-repeater-blocks).

![The slider in action](./docs/vue-image-split-slider.gif)

## Installation & Usage

This package requires on two installations, a composer package for the Laravel side of things, and a npm package for the Vue.js component.

`composer require dewsign/before-after-repeater`

`npm i vue-before-after-slider`

`php artisan migrate`

Register the Vue component:
```javascript
//resources/js/app.js
//...

import BeforeAfter from 'BeforeAfter'

Vue.use(BeforeAfter)
```

To use, add this repeater to a page and set the original and overlay images. If required, you can set a title and a subtitle which will output above the block.
