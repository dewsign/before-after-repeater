import Hammer from 'hammerjs'
import collect from 'collect.js'

let hammer = null

/**
 * Configure pan listener for Hammer JS
 * 
 * @param {*} binding 
 */
function hookPan(binding) {
    hammer.get('pan').set({
        direction: Hammer.DIRECTION_ALL,
    })

    hammer.on('panstart panend panleft panright pandown panup press tap', (event) => {
        binding.value(event)
    })
}

/**
 * Vue Touch Alert direction
 */
const TouchAlert = {
    bind: (el, binding) => {
        if (hammer) hammer.destroy()
        hammer = new Hammer(el)

        const args = collect(binding.arg.split(':'))

        if (args.contains('pan')) {
            hookPan(binding)
        }
    },
}

export default TouchAlert
