<template>
    <section>
        <div
            ref="container"
            class="before-after"
        >
            <img
                :src="beforeimage"
                :alt="beforealt"
                draggable="false"
            >

            <div
                ref="after"
                class="before-after__after"
            >
                <img
                    :src="afterimage"
                    :alt="afteralt"
                    draggable="false"
                >
            </div>

            <div
                v-touch-alert:pan="BeforeAfter"
                ref="afterToken"
                class="drag-token"
            />
        </div>
    </section>
</template>

<script>
import TouchAlert from './Directives/TouchAlert'

export default {
    name: 'BeforeAfter',

    directives: {
        TouchAlert,
    },

    props: [
        'beforeimage',
        'afterimage',
        'beforealt',
        'afteralt',
    ],

    data() {
        return {
            lastWidth: 0,
            maxWidth: 0,
            testImage: 0,
        }
    },

    computed: {
        afterImage() {
            return this.$refs.after
        },

        afterToken() {
            return this.$refs.afterToken
        },

        container() {
            return this.$refs.container
        },
    },

    mounted() {
        window.addEventListener('resize', this.init)
        this.init()
    },

    methods: {
        BeforeAfter(value) {
            const afterWidth = parseInt(this.afterImage.offsetWidth, 10)
            this.setMaxWidth(afterWidth)
            this.setLastWidth(afterWidth, value)
            if (value.type === 'panright' || value.type === 'panleft') {
                this.setWidth(value.deltaX)
            }
        },

        setMaxWidth(afterWidth) {
            if ((!this.maxWidth) && afterWidth) {
                this.maxWidth = afterWidth * 2
            }
        },

        setLastWidth(afterWidth, value) {
            if ((!this.lastWidth || value.type === 'panstart') && afterWidth) {
                this.lastWidth = afterWidth
            }
        },

        setWidth(panX) {
            let newWidth = panX + this.lastWidth
            if (newWidth > this.maxWidth) {
                newWidth = this.maxWidth
            } else if (newWidth <= 0) {
                this.lastWidth = 0
                newWidth = 0
            }
            this.afterImage.style.width = `${newWidth}px`
            this.afterToken.style.left = `${newWidth}px`
        },

        getMaxWidth() {
            const maxWidthImg = new Image()

            maxWidthImg.onload = (() => {
                const maxWidthImgWidth = maxWidthImg.width

                if (maxWidthImgWidth < document.documentElement.offsetWidth) {
                    this.container.style.maxWidth = `${maxWidthImgWidth}px`
                    this.maxWidth = maxWidthImgWidth
                }
            })

            maxWidthImg.src = this.beforeimage
        },

        init() {
            this.container.style.maxWidth = 'none'
            this.maxWidth = ''
            this.afterImage.style.width = ''
            this.afterToken.style.left = ''
            this.getMaxWidth()
            this.$forceUpdate()
        },
    },
}
</script>

<style lang="scss">
.before-after {
    position: relative;
    width: 100%;
    overflow: hidden;
    user-select: none;
    margin-bottom: 1px;

    img {
    display: block;
    transition: filter 0.25s ease-in-out;
    pointer-events: none;

        a &:hover {
            background: none;
            box-shadow: none;
        }
    }

    &__after {
        position: absolute;
        width: 50%;
        top: 0;
        left: 0;
        height: 100%;
        overflow: hidden;
        box-shadow: 3px 0 6px -5px #777;

        img {
            min-width: 100%;
            height: 100%;
            max-width: none;
        }
    }

    &:hover {
        .drag-token {
            animation-play-state: paused;
        }

        .drag-token::after,
        .drag-token::before {
            transform: scale(1.1);
            opacity: 0.8;
        }

        .drag-token::after {
            //
        }
    }

    .drag-token {
        position: absolute;
        height: 50%;
        left: 50%;
        top: 25%;
        animation-duration: 1s;
        animation-name: pulse;
        animation-iteration-count: infinite;
        animation-direction: alternate;

        &::after {
            content: '';
            display: block;
            position: absolute;
            right: 0;
            top: 50%;
            margin-top: -25px;
            margin-right: -25px;
            height: 50px;
            width: 50px;
            background-color: rgba(#2d2926, 0.8);
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E");
            background-position: 75% center;
            background-repeat: no-repeat;
            background-size: 10px;
            border-radius: 100%;
            transition: transform 0.2s, opacity 0.2s;
        }

        &::before {
            content: '';
            display: block;
            position: absolute;
            right: 0;
            top: 50%;
            margin-top: -25px;
            margin-right: -25px;
            height: 50px;
            width: 50px;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E");
            background-position: 25% center;
            background-repeat: no-repeat;
            background-size: 10px;
            z-index: 1;
            transition: transform 0.2s, opacity 0.2s;
        }

        @keyframes pulse {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }
    }
}

</style>
