<template>
    <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
        <div class="card-profile-actions py-4 mt-lg-0">
            <base-button type="info" size="sm" class="mr-4" @click="fetchStates">Refresh
            </base-button>
            <base-button type="warning" size="sm" class="float-right">Logout</base-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ButtonsSection",
        props: {
            fetchStates: Function,
        }
    }
</script>