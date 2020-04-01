<template>
    <div class="col-lg-3 order-lg-2">
        <div class="card-profile-image">
            <img v-lazy="avatar">
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfilePicture",
        data() {
            return {
                avatar: 'img/theme/avatar.png'
            }
        }
    }
</script>