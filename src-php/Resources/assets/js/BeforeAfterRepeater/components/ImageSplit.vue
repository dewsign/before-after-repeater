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
    export default {
        name: 'v-image-split',
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
