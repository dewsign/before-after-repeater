import RollupPluginVue from 'rollup-plugin-vue'
import RollupPluginBabel from 'rollup-plugin-babel'

export default {
    input: 'src-js/index.js',
    output: {
        file: 'dist-js/index.js',
        format: 'cjs',
    },
    external: [
        'vue',
        'hammerjs',
        'collect.js',
        'vue-runtime-helpers/normalize-component.js',
        'vue-runtime-helpers/inject-style/browser.js',
    ],
    plugins: [
        RollupPluginVue(),
        RollupPluginBabel({
            exclude: 'node_modules/**',
        }),
    ],
}
