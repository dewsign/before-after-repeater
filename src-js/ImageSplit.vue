<template>
    <section>
        <div class="image-split">
            <img draggable="false" :src="originalimage" :alt="originalalt">
            <div class="image-split__overlay" ref="overlayImage">
                <img draggable="false" :src="overlayimage" :alt="overlayalt">
            </div>
            <div class="drag-token" ref="overlayToken" v-touch-alert:pan="imageSplit"></div>
        </div>
    </section>
</template>

<script>
import TouchAlert from './Directives/TouchAlert'

export default {
    name: 'ImageSplit',
    directives: {
        TouchAlert,
    },
    props: [
        'originalimage',
        'overlayimage',
        'originalalt',
        'overlayalt',
    ],
    data() {
        return {
            lastWidth: 0,
            maxWidth: 0,
        }
    },
    computed: {
        overlayImage() {
            return this.$refs.overlayImage
        },
        overlayToken() {
            return this.$refs.overlayToken
        },
    },
    mounted() {
        window.addEventListener('resize', this.windowResize)
    },
    methods: {
        imageSplit(value) {
            const overlayWidth = parseInt(this.overlayImage.offsetWidth, 10)
            this.setMaxWidth(overlayWidth)
            this.setLastWidth(overlayWidth, value)
            if (value.type === 'panright' || value.type === 'panleft') {
                this.setWidth(value.deltaX)
            }
        },
        setMaxWidth(overlayWidth) {
            if ((!this.maxWidth) && overlayWidth) {
                this.maxWidth = overlayWidth * 2
            }
        },
        setLastWidth(overlayWidth, value) {
            if ((!this.lastWidth || value.type === 'panstart') && overlayWidth) {
                this.lastWidth = overlayWidth
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
            this.overlayImage.style.width = `${newWidth}px`
            this.overlayToken.style.left = `${newWidth}px`
        },
        windowResize() {
            const overlayWidth = parseInt(this.overlayImage.offsetWidth, 10)
            this.maxWidth = overlayWidth * 2
            this.lastWidth = overlayWidth * 2
            this.overlayImage.style.width = ''
            this.overlayToken.style.left = ''
        },
    },
}
</script>

<style lang="scss">

section {
    box-sizing: border-box;
}

img {
    display: block;
    transition: filter 0.25s ease-in-out;

    a &:hover {
        background: none;
        box-shadow: none;
    }
}
/** @define image-split */
.image-split {
    position: relative;
    width: 100%;
    overflow: hidden;
    user-select: none;
    margin-bottom: 1px;

    img {
        pointer-events: none;
    }

    &__overlay {
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
        background-image: url("img/arrow-right-icon.svg");
        background-position: 75% center;
        background-repeat: no-repeat;
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
        background-image: url("img/arrow-left-icon.svg");
        background-position: 25% center;
        background-repeat: no-repeat;
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


</style>

