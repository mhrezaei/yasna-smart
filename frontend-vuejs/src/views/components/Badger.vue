<template>
    <badge pill :type="type" v-if="condition">{{ label }}</badge>
</template>

<script>
    import badge from '../../components/Badge';

    export default {
        name: "Badge",
        components: {
            badge
        },
        props: {
            type: String,
            condition: Boolean,
            label: String,
        },
    }
</script>