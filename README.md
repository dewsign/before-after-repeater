# Before After Repeater Block

A before/after image comparison repeater block for [Dewsign's Nova Repeater Blocks](https://github.com/dewsign/nova-repeater-blocks).

![The slider in action](./docs/vue-image-split-slider.gif)

## Installation & Usage

This package requires on two installations, a composer package for the laravel side of things, and a npm package for the vue component.

`composer require dewsign/before-after-repeater`

`npm i vue-image-split-slider`

`php artisan migrate`

Register the Vue component:
```javascript
//resources/js/app.js
//...

import VueImageSplitSlider from 'vue-image-split-slider'

Vue.use(VueImageSplitSlider)
```

To use, add this repeater to a page and set the original and overlay images. If required, you can set a title and a subtitle which will output above the block.
