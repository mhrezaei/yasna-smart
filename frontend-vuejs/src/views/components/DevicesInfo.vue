<template>
    <div class="col-lg-4 order-lg-1">
        <div class="card-profile-stats d-flex justify-content-center">
            <div>
                <span class="heading">
                    <badger :type="statusColor" :condition="true" :label="status"></badger>
                </span>
                <span class="description">Status</span>
            </div>
            <div>
                <span class="heading">
                    <badger :type="'info'" :condition="true" :label="date"></badger>
                </span>
                <span class="description">Update</span>
            </div>
            <div>
                <span class="heading">
                    <badger :type="'info'" :condition="true" :label="nodes.toString()"></badger>
                </span>
                <span class="description">Nodes</span>
            </div>
        </div>
    </div>
</template>

<script>
    import badger from "./Badger";

    export default {
        name: "DevicesInfo",
        components: {
            badger,
        },
        props: [
            'statusColor',
            'status',
            'date',
            'nodes'
        ],
    }
</script>